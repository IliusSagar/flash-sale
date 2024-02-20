<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flash Sale</title>
    <style>
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <!-- resources/views/exam/show.blade.php -->
    <h1>Hello :)</h1>

    <table>
        <thead >
            <tr>
                <td>Title</td>
                <td>Start Time</td>
                <td>End Time</td>
                <td>Left Time</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>

            @php
              $flash = DB::table('flash_sales')->get();
            @endphp

            @foreach ($flash as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->start_time }}</td>
                    <td>{{ $item->end_time }}</td>
                    @php
                    // $diffInSeconds = now()->diffInSeconds($item->end_time);
                    // $diffInSeconds = now()->diff($item->end_time);

                    $endTime = Carbon\Carbon::parse($item->end_time);

// Get the difference between now and end time
$diff = now()->diff($endTime);

// Format the difference in a human-readable way
$formattedDiff = $diff->format('%d days, %h hours, %i minutes, %s seconds');


                @endphp

                    {{-- <td>{{ $formattedDiff }}</td> --}}

                    <td id="countdown">{{ $formattedDiff }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    

{{-- <h1>{{ $exam->title }}</h1>
<p>Time left: {{ $timeLeft }} seconds</p> --}}

<script>
    // Function to update the countdown every second
    function updateCountdown() {
        let countdownElement = document.getElementById('countdown');
        let timeArray = countdownElement.innerText.split(/\s+/);
        let days = parseInt(timeArray[0]);
        let hours = parseInt(timeArray[2]);
        let minutes = parseInt(timeArray[4]);
        let seconds = parseInt(timeArray[6]);

        let totalSeconds = days * 24 * 60 * 60 + hours * 60 * 60 + minutes * 60 + seconds;

        if (totalSeconds > 0) {
            totalSeconds--;
            days = Math.floor(totalSeconds / (24 * 60 * 60));
            hours = Math.floor((totalSeconds % (24 * 60 * 60)) / (60 * 60));
            minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
            seconds = totalSeconds % 60;

            countdownElement.innerText = `${days} days, ${hours} hours, ${minutes} minutes, ${seconds} seconds`;
        } else {
            // Optionally, you can add code to handle the countdown reaching zero
            countdownElement.innerText = 'Countdown expired';
        }
    }

    // Update the countdown every second
    setInterval(updateCountdown, 1000);
</script>

</body>
</html>