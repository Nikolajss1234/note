<?php

namespace Tests\Feature\Notes;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_redirect_if_guest()
    {
        $response = $this->get(route('notes'));
        $response->assertStatus(302);
    }

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_return_right_view()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->get(route('notes'));
        $response->assertStatus(200);
    }

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_create_as_guest()
    {
        $response = $this->get(route('notes.create'));
        $response->assertStatus(302);
        $this->assertEquals(0, Note::all()->count());
    }

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_create_success()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->post(route('notes.create'));
        $response->assertStatus(200);

        $this->assertEquals(1, $user->fresh()->notes()->count());
    }

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_update_success()
    {
        $this->actingAs($user = User::factory()->create());
        $note = $user->notes()->create();

        $response = $this->put(route('notes.update', ['note' => $note->id]), ['text' => 'test 123']);
        $response->assertStatus(200);
        $this->assertTrue($response->getOriginalContent());

        $this->assertEquals('test 123', $note->fresh()->text);
    }

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_update_not_owner()
    {
        $user = User::factory()->create();
        $note = $user->notes()->create(['text' => 'old']);

        $this->actingAs(User::factory()->create());

        $response = $this->put(route('notes.update', ['note' => $note->id]), ['text' => 'new']);
        $response->assertStatus(200);
        $this->assertFalse($response->getOriginalContent());

        $this->assertEquals('old', $note->fresh()->text);
    }

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_update_guest()
    {
        $user = User::factory()->create();
        $note = $user->notes()->create(['text' => 'old']);

        $response = $this->put(route('notes.update', ['note' => $note->id]), ['text' => 'new']);
        $response->assertStatus(302);

        $this->assertEquals('old', $note->fresh()->text);
    }

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_delete_success()
    {
        $this->actingAs($user = User::factory()->create());
        $note1 = $user->notes()->create();
        $note2 = $user->notes()->create();

        $this->assertEquals(2, $user->notes()->count());

        $response = $this->delete(route('notes.delete', ['note' => $note1->id]));
        $response->assertStatus(200);
        $this->assertTrue($response->getOriginalContent());

        $this->assertEquals(1, $user->notes()->count());
        $this->assertEquals($note2->id, $user->notes()->first()->id);
    }

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_delete_not_owner()
    {
        $user = User::factory()->create();
        $note1 = $user->notes()->create();

        $this->assertEquals(1, $user->notes()->count());

        $this->actingAs(User::factory()->create());

        $response = $this->delete(route('notes.delete', ['note' => $note1->id]));
        $response->assertStatus(200);
        $this->assertFalse($response->getOriginalContent());

        $this->assertEquals(1, $user->notes()->count());
    }

    /**
     * @group notes
     * @group Feature
     * @test
     */
    public function test_delete_guest()
    {
        $user = User::factory()->create();
        $note1 = $user->notes()->create();

        $this->actingAs(User::factory()->create());

        $response = $this->delete(route('notes.delete', ['note' => $note1->id]));
        $response->assertStatus(200);
        $this->assertFalse($response->getOriginalContent());

        $this->assertEquals(1, $user->notes()->count());
    }

}
