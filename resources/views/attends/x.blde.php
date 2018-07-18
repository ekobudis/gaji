
                        <tbody>
                            @foreach($attend as $absen)
                            <tr>
                                <td>{{ $absen->pegawai->emp_name }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($absen->attend_date)->format('d-M-y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($absen->attend_time_in)->format('H:i') }}</td>
                                <td class="text-center">
                                    @if($absen->attend_time_out != null)
                                    {{ \Carbon\Carbon::parse($absen->attend_time_out)->format('H:i') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($absen->attend_time_out != null)
                                    @php 
                                        $jam_masuk = $absen->attend_time_in;
                                        $jam_keluar = $absen->attend_time_out;
                                        echo $totalJam = $jam_keluar->Carbon::diffInSeconds($jam_masuk);
                                    
                                    @endphp
                                    {{ \Carbon\Carbon::parse($totalJam)->format('H:i') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($absen->attend_overtime_start != null)
                                    {{ \Carbon\Carbon::parse($absen->attend_overtime_start)->format('H:i') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($absen->attend_overtime_end != null)
                                    {{ \Carbon\Carbon::parse($absen->attend_overtime_end)->format('H:i') }}
                                    @endif
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <a href="#" onclick="attendOut('{{ $absen->id }}')" ><i class="fa fa-edit"></i></a>
                                    <a href="#" onclick="showDelete('{{ $absen->id }}')"><i class="fa fa-trash"></i></a>    
                                    <a href="#" onclick="JamMasukLembur('{{ $absen->id }}')"><i class="fa fa-calendar-check-o"></i></a>
                                    <a href="#" onclick="JamKeluarLembur('{{ $absen->id }}')"><i class="fa fa-calendar-times-o"></i></a>
                                </td>
                            </tr>    
                            @endforeach
                        </tbody>