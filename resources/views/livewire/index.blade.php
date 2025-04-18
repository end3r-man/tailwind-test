<div x-data="tableDrop()">
    <div class="w-full py-10 px-8">
        <div class="w-full h-16 bg-white rounded-xl shadow-xs flex items-center justify-between px-6">
            <h1 class="text-xl font-semibold">OnGoing Trip</h1>
            <div>
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn m-1">Per Page <kbd class="kbd kbd-sm">5</kbd>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-36 p-2 mt-1 shadow-sm">
                        <li><a>5</a></li>
                        <li><a>10</a></li>
                        <li><a>15</a></li>
                        <li><a>20</a></li>
                        <li><a>50</a></li>
                        <li><a>100</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <x-dashboard.table.layout>

        <x-dashboard.table.filter />

        <x-dashboard.table.table>

            <x-dashboard.table.head>
                <th></th>
                <th>S.No</th>
                <th>Father Name</th>
                <th>Student Name</th>
                <th>Father Number</th>
                <th>SOS Number</th>
                <th>Student</th>
                <th>Driver</th>
            </x-dashboard.table.head>

            <x-dashboard.table.body :process="true">
                @if ($onpage && count($customerOnGoingTrips) > 0)
                    @foreach ($customerOnGoingTrips as $c)
                        <tr>
                            <td @click="toggle({{ $c->id }})">
                                <span class="icon-[gridicons--add] text-lg text-emerald-500"></span>
                            </td>
                            <td>{{ $customerOnGoingTrips->firstItem() + $loop->index }}</td>
                            <td>{{ $c->child->customer->father_name ?? $c->child->customer->mother_name }}</td>

                            <td>{{ $c->child->student_name }}</td>
                            <td>{{ $c->child->customer->father_number }}</td>
                            <td>{{ $c->child->customer->sos_number }}</td>
                            <td>
                                <div class="avatar">
                                    <div class="w-12 rounded">
                                        <img
                                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="avatar">
                                    <div class="w-12 rounded">
                                        <img
                                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr x-cloak x-show="open == {{ $c->id }}">
                            <th colspan="9">
                                <table class="table">
                                    <!-- head -->
                                    <thead class="table-head">
                                        <tr>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Location</th>
                                            <th>Driver Name</th>
                                            <th>Driver Number</th>
                                            <th>Driver Vechicle No</th>
                                            <th>Student Location</th>
                                            <th>School Location</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <!-- row 1 -->
                                        <tr>
                                            <td>{{ $c->start_time }}</td>
                                            <td>{{ $c->end_time }}</td>
                                            <td>{{ $c->latitude . ' ' . $c->longitude }}</td>
                                            <td>{{ $c->trip->driver->user->name }}</td>
                                            <td>{{ $c->trip->driver->user->phone ? $c->trip->driver->user->phone : 'NULL' }}
                                            </td>
                                            <td>{{ $c->trip->driver->driverKyc->vehicle_number }}</td>
                                            <td>{{ json_decode($c->child->student_location)->latitude . ' ' . json_decode($c->child->student_location)->longitude }}
                                            </td>
                                            <td>{{ json_decode($c->child->school_location)->latitude . ' ' . json_decode($c->child->school_location)->longitude }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </th>
                        </tr>
                    @endforeach
                @elseif($onpage && count($customerOnGoingTrips) <= 0)
                    <tr>
                        <td colspan="12">No Customer Found!</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="12">Processing...</td>
                    </tr>
                @endif
            </x-dashboard.table.body>

        </x-dashboard.table.table>

        @if (count($customerOnGoingTrips) > 0)
            {{ $customerOnGoingTrips->links() }}
        @endif

    </x-dashboard.table.layout>
</div>

@push('js')
    <script>
        function tableDrop() {
            return {
                open: null,

                toggle(id) {
                    if (this.open == id) {
                        this.open = null
                        return;
                    }

                    this.open = id
                }
            }
        }
    </script>
@endpush
