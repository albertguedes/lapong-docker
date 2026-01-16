<h2 class="text-center mt-3 mb-5" >{{ __('messages.calendar') }} {{ now()->format('M Y') }}</h2>

<table class="table table-unbordered" >
    <tbody>
        <tr>
            @foreach([ __('messages.sun'), __('messages.mon'), __('messages.tue'), __('messages.wed'), __('messages.thu'), __('messages.fri'), __('messages.sat') ] as $week_day_name)
            <th class="text-center bg-transparent border-0" >
                <h2 class="card-title">{{ $week_day_name }}</h2>
            </th>
            @endforeach
        </tr>

        @for($w = 0; $w < $max_weeks; $w++)
        <tr>
            @for($d = 0; $d < 7; $d++)
            <td class="align-top border-0 bg-transparent" >
                @if((7*$w+$d + 1 - $first_day_week) < 1)
                <div class="card card-calendar bg-secondary-subtle" >
                    <div class="card-header bg-transparent text-end border-0 p-0 pt-2 pe-2" >
                        <h2 class="card-title">{{ $last_day_previous_month + (7*$w+$d + 1 - $first_day_week) }}</h2>
                    </div>
                    <div class="card-body  bg-transparent p-0 px-1 pb-3">
                    </div>
                </div>
                @elseif((7*$w+$d + 1) > $last_month_day)
                <div class="card card-calendar bg-secondary-subtle" >
                    <div class="card-header bg-transparent text-end border-0 p-0 pt-2 pe-2" >
                        <h2 class="card-title">{{ 7*$w+$d - $last_month_day + 1 }}</h2>
                    </div>
                    <div class="card-body  bg-transparent p-0 px-1 pb-3">
                    </div>
                </div>
                @else
                <div class="card card-calendar @if($d==0) sunday @elseif($d==6) saturday @endif" >
                    <div class="card-header text-end border-0 p-0 pt-2 pe-2" >
                        <h2 class="card-title">{{ 7*$w+$d + 1 - $first_day_week }}</h2>
                    </div>
                    <div class="card-body p-0 px-1 pb-3">
                        @foreach($events_for_day[7*$w+$d] as $event)
                        <div class="card-text p-0 overflow-auto" >
                            <a href="{{ $event['route'] }}"
                            class="badge rounded-0 bg-{{ ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'][rand(0,7)] }} rounded-2 text-start w-100" >
                                {{ $event['begin'] }}
                                @if(strlen($event['title'])>15)
                                {{ substr($event['title'], 0, 15) }}...
                                @else
                                {{ $event['title'] }}
                                @endif
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </td>
            @endfor
        </tr>
        @endfor
    </tbody>
</table>
