<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Manage Appointments, Quotes & Users</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f3f5;
            padding: 30px;
        }
        h1 {
            text-align: center;
            color: #000;
            padding: 15px 0;
            font-family: 'Georgia', serif;
            font-size: 28px;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px 5px 0 0;
            user-select: none;
        }
        .tab.active {
            background-color: #fff;
            border-bottom: none;
            font-weight: bold;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }

        table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        th {
            background: rgb(0, 0, 0);
            color: white;
        }

        input[type="date"], input[type="time"], input.price-quote-input {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input.price-quote-input {
            width: 100px;
            margin-right: 6px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            vertical-align: middle;
            padding: 0;
        }

        /* Buttons */
        .btn {
            padding: 8px 12px;
            margin: 2px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-reschedule {
            background-color: #5a5a5a;
            color: white;
            border: 1px solid #555;
        }
        .btn-reschedule:hover {
            background-color: #7d7d7d;
            box-shadow: 0 2px 4px rgba(0,0,0,0.4);
        }

        .btn-confirm {
            background-color: #2e2e2e;
            color: white;
            border: 1px solid #444;
        }
        .btn-confirm:hover {
            background-color: #444;
            box-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .btn-cancel {
            background-color: #dcdcdc;
            color: #111;
            border: 1px solid #bbb;
        }
        .btn-cancel:hover {
            background-color: #cfcfcf;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .btn-delete {
            background-color: #555;
            color: white;
            border: 1px solid #444;
        }
        .btn-delete:hover {
            background-color: #444;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .btn-send-quote {
            background-color: #222;
            color: white;
            border: 1px solid #444;
        }
        .btn-send-quote:hover {
            background-color: #333;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        /* Status Styles */
        tr.row-status-Confirmed { background-color: #2e2e2e; color: #fff; }
        tr.row-status-Rescheduled { background-color: #5a5a5a; color: #fff; }
        tr.row-status-Cancelled { background-color: #dcdcdc; color: #111; }
        
        #filter-container {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }

        #filter-container label { font-weight: bold; }
        #filter-container input[type="date"] { padding: 5px; width: 160px; }
        #filter-container button {
            padding: 6px 14px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<h1>Manage Appointments, Quote Requests & Users</h1>

<div id="filter-container">
    <label for="filter-start-date">Start Date:</label>
    <input type="date" id="filter-start-date">
    <label for="filter-end-date">End Date:</label>
    <input type="date" id="filter-end-date">
    <button id="filter-btn">Filter</button>
    <button id="clear-filter-btn" onclick="location.reload()">Clear</button>
</div>

<div class="tabs">
    <div class="tab active" data-tab="appointments">Appointments</div>
    <div class="tab" data-tab="quotes">Quote Requests</div>
    <div class="tab" data-tab="users">User Accounts</div>
</div>

<!-- Appointments Tab -->
<div class="tab-content active" id="appointments">
    <table>
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Date</th><th>Time</th><th>Notes</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $row)
            <tr id="appointment-row-{{ $row->id }}" class="row-status-{{ $row->status }}">
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->date }}</td>
                <td>{{ $row->time }}</td>
                <td>{{ $row->notes }}</td>
                <td>{{ $row->status }}</td>
                <td>
                    <input type="date" id="date-{{ $row->id }}">
                    <input type="time" id="time-{{ $row->id }}">
                    <button class="btn btn-reschedule" onclick="reschedule({{ $row->id }})">Reschedule</button>
                    <button class="btn btn-confirm" onclick="confirmAppointment({{ $row->id }})">Confirm</button>
                    <button class="btn btn-cancel" onclick="cancelAppointment({{ $row->id }})">Cancel</button>
                    <button class="btn btn-delete" onclick="deleteAppointment({{ $row->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Quotes Tab -->
<div class="tab-content" id="quotes">
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Service Type</th>
                <th>Size</th><th>Image</th><th>Materials</th><th>Project Details</th><th>Price Quote</th><th>Submitted At</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotes as $row)
            <tr id="quote-row-{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ $row->service_type }}</td>
                <td>
                    @if($row->size === 'custom')
                        <small><strong>Custom:</strong><br>{{ $row->custom_size }}</small>
                    @else
                        {{ $row->size }}
                    @endif
                </td>
                <td>
                    @if($row->inspiration_image)
                        <a href="{{ asset('storage/' . $row->inspiration_image) }}" target="_blank" title="Click to view full image">
                            <img src="{{ asset('storage/' . $row->inspiration_image) }}" style="max-height: 40px; border-radius: 4px; border: 1px solid #ccc;">
                        </a>
                    @else
                        <span style="color:#aaa;font-size:0.8rem;">None</span>
                    @endif
                </td>
                <td>{{ $row->selected_materials }}</td>
                <td>{{ $row->details }}</td>
                <td>
                    <input type="number" id="price-quote-{{ $row->id }}" class="price-quote-input" value="{{ $row->price_quote }}">
                    <button class="btn btn-send-quote" onclick="sendQuote({{ $row->id }})">Send Quote</button>
                </td>
                <td>{{ $row->created_at }}</td>
                <td><button class="btn btn-delete" onclick="deleteQuote({{ $row->id }})">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Users Tab -->
<div class="tab-content" id="users">
    <table>
        <thead>
            <tr>
                <th>Full Name</th><th>Email</th><th>Address</th><th>Contact</th><th>Created At</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $row)
            <tr id="user-row-{{ $row->id }}">
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->address }}</td>
                <td>{{ $row->contact }}</td>
                <td>{{ $row->created_at }}</td>
                <td><button class="btn btn-delete" onclick="deleteUser({{ $row->id }}, '{{ $row->name }}')">Delete User</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function showToast(message, success) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.cssText = `position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); background-color: ${success ? '#28a745' : '#dc3545'}; color: white; padding: 10px 20px; border-radius: 4px; z-index: 10000;`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    // Appointment actions
    function sendAppointmentAction(id, action, date=null, time=null) {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('appointment_action', action);
        if(date) formData.append('new_date', date);
        if(time) formData.append('new_time', time);

        fetch("{{ route('admin.appointment.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.json())
        .then(data => {
            showToast(data.message, true);
            location.reload();
        });
    }

    function reschedule(id) {
        const date = document.getElementById('date-'+id).value;
        const time = document.getElementById('time-'+id).value;
        if(!date || !time) return showToast('Select date and time', false);
        sendAppointmentAction(id, 'reschedule', date, time);
    }
    function confirmAppointment(id) { sendAppointmentAction(id, 'confirm'); }
    function cancelAppointment(id) { sendAppointmentAction(id, 'cancel'); }
    function deleteAppointment(id) { if(confirm('Delete?')) sendAppointmentAction(id, 'delete'); }

    // Quote actions
    function sendQuote(id) {
        const price = document.getElementById('price-quote-'+id).value;
        const formData = new FormData();
        formData.append('id', id);
        formData.append('quote_action', 'send_quote');
        formData.append('price_quote', price);

        fetch("{{ route('admin.quote.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.json())
        .then(data => showToast(data.message, true));
    }

    function deleteQuote(id) {
        if(!confirm('Delete?')) return;
        const formData = new FormData();
        formData.append('id', id);
        formData.append('quote_action', 'delete');
        fetch("{{ route('admin.quote.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        }).then(() => location.reload());
    }

    // User actions
    function deleteUser(id, name) {
        if(!confirm('Delete '+name+'?')) return;
        const formData = new FormData();
        formData.append('user_id', id);
        formData.append('user_action', 'delete');
        fetch("{{ route('admin.user.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        }).then(() => location.reload());
    }

    // Tabs
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.tab, .tab-content').forEach(el => el.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(tab.dataset.tab).classList.add('active');
        });
    });

    // Filter
    document.getElementById('filter-btn').addEventListener('click', () => {
        const start = document.getElementById('filter-start-date').value;
        const end = document.getElementById('filter-end-date').value;
        const formData = new FormData();
        formData.append('filter_start_date', start);
        formData.append('filter_end_date', end);

        fetch("{{ route('admin.filter.appointments') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.text())
        .then(html => document.querySelector('#appointments tbody').innerHTML = html);
    });
</script>

</body>
</html>
