<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;


    public function testSubmissionCorrectData(): void
    {
        $data = [
            "name" => "John Doe",
            "email" => "john.doe@example.com",
            "message" => "This is a test message",
        ];

        $response = $this->post('/api/submit', $data);

        $response->assertStatus(202);
        $response->assertJson(['status' => true]);

        $this->assertDatabaseHas('submissions', [
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);
    }

    public function testSubmissionNoData(): void
    {
        $data = [
            "name" => "",
            "email" => "",
            "message" => "",
        ];

        $response = $this->post('/api/submit', $data);

        $response->assertStatus(200);
        $response->assertJson([
            "status" => false, "errors" => [
                "The name field is required.", "The email field is required.", "The message field is required."
            ]
        ]);

        $this->assertDatabaseMissing('submissions', [
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);
    }

    public function testSubmissionInvalidData(): void
    {
        $data = [
            "name" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc diam massa, euismod a dui eget, consectetur dapibus lorem. Aliquam at leo nec nisl tempus ultricies quis a erat. Donec ac erat lobortis, volutpat mauris at, fringilla nisi. Quisque vitae facilisis orci, vel porta sem. Maecenas vitae ultrices lorem. Ut sit amet libero quis nibh cursus mollis nec non nisi. Cras at libero semper, vulputate justo non, mattis metus. Cras quis nisi sagittis, ultrices purus sed, pharetra justo. Quisque sem eros, auctor non lacus ut, elementum tristique est. Pellentesque nisl est, feugiat a nisi a, venenatis mattis tellus. Nam cursus viverra.",
            "email" => "johndoe",
            "message" => "",
        ];

        $response = $this->post('/api/submit', $data);

        $response->assertStatus(200);
        $response->assertJson([
            "status" => false, "errors" => [
                "The name field must not be greater than 255 characters.",
                "The email field must be a valid email address.", "The message field is required."
            ]
        ]);

        $this->assertDatabaseMissing('submissions', [
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);
    }
}
