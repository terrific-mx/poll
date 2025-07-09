# Plan: Listing All Polls in the Dashboard

## Objective
Display a list of all polls stored in the database on the dashboard page using a Livewire Volt component.

## Steps

1. **Fetch Polls from Database**
   - Use the `Poll` model to retrieve all polls from the database.
   - Store the result in a public property (e.g., `$polls`) in the Livewire Volt component.

2. **Expose Polls to the View**
   - Ensure the `$polls` property is available to the Blade view for rendering.

3. **Display Polls in Blade**
   - In the Blade section of the component, loop through the `$polls` collection.
   - For each poll, display relevant details (e.g., title, description, created date).

## Example Implementation

- In the Volt component:
  ```php
  use App\Models\Poll;

  public $polls;

  public function mount()
  {
      $this->polls = Poll::all();
  }
  ```

- In the Blade view:
  ```blade
  <div>
      @foreach ($polls as $poll)
          <div>{{ $poll->title }}</div>
      @endforeach
  </div>
  ```

## Next Steps
- Implement the above plan in the `dashboard.blade.php` Volt component.
- Test to ensure all polls are listed correctly.
