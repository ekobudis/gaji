@foreach($absens as $absen)
    @php 
        $masuk = \Carbon\Carbon::parse($absen->attend_time_in);
        $keluar = \Carbon\Carbon::parse($absen->attend_time_out);
        $total = $keluar->diffInHours($masuk);
        $menit = $keluar->diffInMinutes($masuk);
        if($total>8){
            $jam = $total-1;
        }else{
            $jam = $total;
        }
        $lembur_masuk = \Carbon\Carbon::parse($absen->attend_overtime_start);
        $lembur_keluar = \Carbon\Carbon::parse($absen->attend_overtime_end);
        $lembur_total = $lembur_keluar->diffInHours($lembur_masuk);
        $lembur_menit = $lembur_keluar->diffInMinutes($lembur_masuk);
    @endphp
    <tr>
        <td><div class="text-center">{{ \Carbon\Carbon::parse($absen->attend_date)->format('d-M-y') }} </div></td>
        <td><div class="text-center"> {{ \Carbon\Carbon::parse($absen->attend_time_in)->format('H:i') }} </div></td>
        <td>
            @if($absen->attend_time_out != null)
            <div class="text-center">{{ \Carbon\Carbon::parse($absen->attend_time_out)->format('H:i') }} </div>
            @else
            <div class="text-center"></div>
            @endif
        </td>
        <td>
            @if($absen->attend_time_out != null)
            <div class="text-center">{{ $jam }} </div>
            @else
            <div class="text-center"></div>
            @endif
        </td>
        <td>
            @if($absen->attend_time_out != null)
            <div class="text-center">{{ \Carbon\Carbon::parse($absen->attend_overtime_start)->format('H:i') }} </div>
            @else
            <div class="text-center"></div>
            @endif
        </td>
        <td>
            @if($absen->attend_time_out != null)
            <div class="text-center">{{ \Carbon\Carbon::parse($absen->attend_overtime_end)->format('H:i') }} </div>
            @else
            <div class="text-center"></div>
            @endif
        </td>
        <td>
            @if($absen->attend_overtime_end != null)
                <div class="text-center">{{ $lembur_total }} </div>
            @else
                <div class="text-center"> </div>
            @endif
        </td>
    </tr>
@endforeach