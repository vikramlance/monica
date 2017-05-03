<div class="col-xs-12 section-title">
  <img src="/img/people/reminders.svg" class="icon-section icon-reminders">
  <h3>
    {{ trans('people.section_personal_reminders') }}

    <span>
      <a href="/people/{{ $contact->id }}/reminders/add">{{ trans('people.reminders_cta') }}</a>
    </span>
  </h3>
</div>


@if ($contact->getNumberOfReminders() == 0)

  <div class="col-xs-12">
    <div class="section-blank">
      <h3>{{ trans('people.reminders_blank_title', ['name' => $contact->getFirstName()]) }}</h3>
      <a href="/people/{{ $contact->id }}/reminders/add">{{ trans('people.reminders_blank_add_activity') }}</a>
    </div>
  </div>

@else

  <div class="col-xs-12 reminders-list">

    <p>{{ trans('people.reminders_description') }}</p>

    <table class="table table-sm table-hover">
      <thead>
        <tr>
          <th>Date</th>
          <th>Frequency</th>
          <th>Content</th>
          <th class="actions">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($contact->getReminders() as $reminder)
          <tr>
            <td class="date">{{ $reminder->getNextExpectedDate() }}</td>

            <td class="date">
              @if ($reminder->frequency_type != 'one_time')
                {{ trans_choice('people.reminder_frequency_'.$reminder->frequency_type, $reminder->frequency_number, ['number' => $reminder->frequency_number]) }}
              @else
                One time
              @endif
            </td>

            <td>
              {{ $reminder->getTitle() }}
            </td>

            <td class="actions">

              @if ($reminder->getReminderType() != 'birthday' and $reminder->getReminderType() != 'birthday_kid')

              <div class="reminder-actions">
                <ul class="horizontal">
                  <li><a href="/people/{{ $contact->id }}/reminders/{{ $reminder->id }}/delete" onclick="return confirm('{{ trans('people.reminders_delete_confirmation') }}')">{{ trans('people.reminders_delete_cta') }}</a></li>
                </ul>
              </div>

              @endif

            </td>

            @if (!is_null($reminder->getDescription()))
            <td class="reminder-comment">
              {{ $reminder->getDescription() }}
            </td>
            @endif

          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endif
