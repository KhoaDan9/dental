<div>
    <div class="flex justify-between print-invoice-menu">
        <span>Dữ liệu >> <a href="/patients">Hồ sơ bệnh nhân</a>
            >>
            <a href="/patients/{{ $patient->id }}">{{ $patient->clinic_id }}.{{ $patient->id }}</a>
            >>
            <a href="#">In bệnh án</a>
        </span>
        <div class="flex space-x-2">
            Từ lần
            <select class="border border-gray-600 mx-1" wire:model="from_visit_count">
                @foreach ($visit_counts as $visit_count)
                    <option value="{{ $visit_count }}">{{ $visit_count }}</option>
                @endforeach
            </select>
            Đến lần
            <select class="border border-gray-600 mx-1" wire:model="to_visit_count">
                @foreach ($visit_counts as $visit_count)
                    <option value="{{ $visit_count }}">{{ $visit_count }}</option>
                @endforeach
            </select>
            <button class="main-button" wire:click="seachInvoice">Tìm</button>
            <button class="main-button" onclick="printInvoice()">In</button>
            <a class="a-button" href="/patients/{{ $patient->id }}">Thoát</a>
        </div>
    </div>
    @cannot('printInvoice', \App\Models\Patient::class)
        <x-cannot-permission/>
    @else
        <div class="print-invoice w-5xl pr-3">
            <div class="flex border-gray-500 border-b-1">
                <img class="w-52" src="{{ Storage::url($clinic->logo_path) }}" alt="">
                <div class="px-4 flex flex-col justify-center">
                    <strong>{{ $clinic->name }}</strong>
                    <p><strong>Địa chỉ: </strong>{{ $clinic->address }}</p>
                    <div class="flex space-x-2">
                        @if ($clinic->phone)
                            <p><strong>Điện thoại: </strong>{{ $clinic->phone }}</p>
                        @endif
                        @if ($clinic->email)
                            <p><strong>Email: </strong>{{ $clinic->email }}</p>
                        @endif
                        @if ($clinic->website)
                            <p><strong>Website: </strong>{{ $clinic->website }}</p>
                        @endif

                    </div>
                    <p><strong>Số tài khoản: </strong>{{ $clinic->bank_account_number }}</p>
                </div>
            </div>
            <div class="flex justify-between">
                <strong>ID: {{ $patient->clinic_id }}.{{ $patient->name }}</strong>
                <p>{{ $clinic->commune }}, <span id="today"></span></p>
            </div>
            <div class="flex justify-center">
                <strong class="text-2xl!">PHIẾU KHÁM BỆNH</strong>
            </div>
            <div class="flex flex-col">
                <p><strong>Họ và tên: </strong>{{ $patient->name }} - <strong>Năm sinh: </strong>{{ $patient->birth }}
                </p>
                <p><strong>Địa chỉ: </strong>{{ $patient->address }}, {{ $patient->city }}</p>
                <p><strong>Điện thoại: </strong>{{ $patient->phone }}</p>
                @if ($from_visit_count == $to_visit_count)
                    <p>Tại lần khám thứ <strong>{{ $from_visit_count }}</strong></p>
                @else
                    <p>Từ lần khám <strong>{{ $from_visit_count }} </strong>đến lần khám
                        <strong>{{ $to_visit_count }}</strong>
                    </p>
                @endif

            </div>

            <div>
                <table class="table-custom table-auto w-full border-collapse border">
                    <tr>
                        <th class="whitespace-nowrap w-0">TT</th>
                        <th class="whitespace-nowrap w-0">Ngày</th>
                        <th class="whitespace-nowrap text-left">Thủ thuật điều trị</th>
                        <th class="whitespace-nowrap w-0">SL</th>
                        <th class="whitespace-nowrap w-0">Đơn giá</th>
                        <th class="whitespace-nowrap w-0">Thành tiền</th>
                        <th class="whitespace-nowrap w-0">Khuyến mại</th>
                        <th class="whitespace-nowrap w-26">Chi phí</th>
                    </tr>
                    @if ($patient_services)
                        @php
                            $stt = 1;
                            $total_price = 0;
                            $total_discount = 0;
                            function convertToString($value)
                            {
                                return number_format($value, 0, ',', '.');
                            }
                        @endphp
                        @foreach ($patient_services->groupBy('visit_count') as $visit_count => $patient_service_sort)
                            @foreach ($patient_service_sort as $patient_service)
                                @php
                                    $total_price += $patient_service->price * $patient_service->quantity;
                                    $total_discount += $patient_service->discount2;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td class="whitespace-nowrap text-center ">
                                        <div class="flex flex-col">
                                            <b>{{ $visit_count }}</b>
                                            {{ $patient_service->date->format('d-m-Y') }}
                                        </div>
                                    </td>
                                    <td class="">
                                        <div>
                                            {{ $patient_service->service_name }}
                                            @if ($patient_service->symptom)
                                                <div class="flex">
                                                    <p class="text-red-600">Triệu chứng: </p>
                                                    <p>{{ $patient_service->symptom }}</p>
                                                </div>
                                            @endif
                                            @if ($patient_service->diagnosis)
                                                <div class="flex">
                                                    <p class="text-red-600">Chẩn đoán: </p>
                                                    <p>{{ $patient_service->diagnosis }}</p>

                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $patient_service->quantity }}</td>
                                    <td class="text-right">{{ convertToString($patient_service->price) }}</td>
                                    <td class="text-right">
                                        {{ convertToString($patient_service->price * $patient_service->quantity) }}
                                    </td>
                                    <td class="text-right">
                                        {{ convertToString($patient_service->discount2) }}
                                    </td>
                                    <td class="text-right">{{ convertToString($patient_service->total_price) }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                    <tr>
                        <td colspan="5" class="text-right">
                            <strong>Tổng chi phí</strong>
                        </td>
                        <td class="text-right">{{ convertToString($total_price) }}</td>
                        <td class="text-right">{{ convertToString($total_discount) }}</td>
                        <td class="text-right">{{ convertToString($this->total_current_price) }}</td>
                    </tr>
                </table>
                <div class="flex">
                    <div class="w-[60%]">
                        @if (count($patient_payments) != 0)
                            <strong>Lịch sử thanh toán</strong>
                            <table class="table-custom table-auto border-collapse border">
                                <tr>
                                    <th class="whitespace-nowrap w-0">TT</th>
                                    <th class="whitespace-nowrap w-0">Ngày</th>
                                    <th class="whitespace-nowrap ">Nội dung</th>
                                    <th class="whitespace-nowrap w-26">Số tiền</th>
                                </tr>

                                @php
                                    $total_paid = 0;
                                @endphp
                                @foreach ($patient_payments as $patient_payment)
                                    @php
                                        $total_paid += $patient_payment->paid;
                                    @endphp
                                    <tr>
                                        <td class=" text-center">{{ $stt++ }}</td>
                                        <td class=" text-center">
                                            {{ \Carbon\Carbon::parse($patient_payment->date)->format('d/m/Y') }}</td>
                                        </td>
                                        <td class="">{{ $patient_payment->detail }}</td>
                                        <td class=" text-right">{{ convertToString($patient_payment->paid) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <strong>Tổng thanh toán</strong>
                                    </td>
                                    <td class="text-right">{{ convertToString($total_paid) }}</td>
                                </tr>
                            </table>
                        @endif

                    </div>
                    <div class="w-[40%] text-right">
                        <div class="w-full">
                            <strong>Tổng chi phí:</strong>
                            <span
                                class="w-26  inline-block pr-[6px]">{{ convertToString($this->total_current_price) }}</span>
                        </div>
                        <div class="w-full">
                            <strong>Nợ cũ:</strong>
                            <span class="w-26  inline-block pr-[6px]">{{ convertToString($this->debt) }}</span>
                        </div>
                        <div class="w-full">
                            <strong>Đã thanh toán:</strong>
                            <span class="w-26  inline-block pr-[6px]">{{ convertToString($this->current_paid) }}</span>
                        </div>
                        <div class="w-full">
                            <strong>Còn lại:</strong>
                            <span class="w-26  inline-block pr-[6px]">{{ convertToString($this->final_debt) }}</span>
                        </div>
                    </div>
                </div>
                @if ($prescription)
                    <div class="">
                        <strong>Đơn thuốc</strong>
                        <pre>{{ $this->prescription }}</pre>
                    </div>
                @endif

                @if ($reminder)
                    <div class="">
                        <strong>Lời dặn</strong>
                        <pre>{{ $this->reminder }}</pre>
                    </div>
                @endif

            </div>
        </div>
    @endcannot
</div>

<script>
    const today = new Date();
    const day = today.getDate();
    const month = today.getMonth() + 1;
    const year = today.getFullYear();

    const formatted = `ngày ${day} tháng ${month} năm ${year}`;
    document.getElementById("today").textContent = formatted;

    function printInvoice() {
        window.print();
    }
</script>
