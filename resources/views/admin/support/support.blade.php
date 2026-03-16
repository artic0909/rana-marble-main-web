@extends('admin.layout.app')

@section('title', 'Support')

@section('content')

<div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-title">Support</h1>
        <p class="page-subtitle">Manage customer support tickets.</p>
    </div>
</div>

<!-- <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="icon-wrap" style="background:#fef9c3;color:#854d0e"><i class="bi bi-ticket"></i></div>
            <div class="value">7</div>
            <div class="label">Open Tickets</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="icon-wrap" style="background:#dbeafe;color:#1d4ed8"><i class="bi bi-clock"></i></div>
            <div class="value">4.2h</div>
            <div class="label">Avg. Response</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="icon-wrap" style="background:#dcfce7;color:#16a34a"><i class="bi bi-check-circle"></i></div>
            <div class="value">94%</div>
            <div class="label">Resolution Rate</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="icon-wrap" style="background:#f3e8ff;color:#7c3aed"><i class="bi bi-star"></i></div>
            <div class="value">4.7★</div>
            <div class="label">CSAT Score</div>
        </div>
    </div>
</div> -->

<div class="card">
    <div class="card-body p-0">
        <div class="px-3 py-3 border-bottom d-flex gap-2 flex-wrap">
            <div class="topbar-search flex-1" style="max-width:300px">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search tickets…"
                    style="width:100%;border-radius:10px;padding:8px 14px 8px 36px;border:1.5px solid var(--border);font-size:13px;outline:none;">
            </div>
            <select class="form-select" style="width:auto;font-size:13px">
                <option>All Tickets</option>
                <option>Open</option>
                <option>In Progress</option>
                <option>Resolved</option>
                <option>Closed</option>
            </select>
            <select class="form-select" style="width:auto;font-size:13px">
                <option>All Priority</option>
                <option>High</option>
                <option>Medium</option>
                <option>Low</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-custom table-hover mb-0">
                <thead style="background:var(--surface2)">
                    <tr>
                        <th style="padding-left:16px">Ticket</th>
                        <th>Customer</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Assigned</th>
                        <th>Updated</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $tickets = [
                    [
                    'id' => '#T0481',
                    'customer' => 'Sarah Chen',
                    'initials' => 'SC',
                    'email' => 'sarah.chen@email.com',
                    'subject' => 'Order not delivered after 2 weeks',
                    'priority' => 'High',
                    'pbadge' => 'badge-high',
                    'assigned' => 'Robert Lee',
                    'updated' => 'Jan 14, 2025',
                    'status' => 'In Progress',
                    'sbadge' => 'badge-inprogress',
                    'order' => '#4488',
                    'created' => 'Jan 12, 2025 · 9:14 AM',
                    'message' => "Hi, I placed an order on December 31st and it still hasn't arrived. It has now been over 2 weeks and I haven't received any shipping updates. The tracking number provided doesn't show any movement since Jan 2nd. This is very frustrating as the item was a gift. Could you please urgently look into this and either arrange a redelivery or process a full refund?",
                    'replies' => [
                    ['from'=>'Robert Lee','role'=>'Support Agent','time'=>'Jan 12, 2025 · 11:30 AM','msg'=>"Hi Sarah, I'm sorry to hear about the delay. I've escalated this to our logistics team and we'll have an update for you within 24 hours. Thank you for your patience.",'agent'=>true],
                    ['from'=>'Sarah Chen','role'=>'Customer','time'=>'Jan 13, 2025 · 8:05 AM','msg'=>"Thank you Robert. I still haven't received any update. Please can you check again? This is urgent.",'agent'=>false],
                    ],
                    ],
                    [
                    'id' => '#T0480',
                    'customer' => 'James Wilson',
                    'initials' => 'JW',
                    'email' => 'james.wilson@email.com',
                    'subject' => 'Wrong item received in order',
                    'priority' => 'High',
                    'pbadge' => 'badge-high',
                    'assigned' => 'Maria Garcia',
                    'updated' => 'Jan 14, 2025',
                    'status' => 'Open',
                    'sbadge' => 'badge-pending',
                    'order' => '#4520',
                    'created' => 'Jan 14, 2025 · 8:45 AM',
                    'message' => "I received my order today but it contained completely the wrong item. I ordered a Wireless Charging Pad but received a phone case instead. Please arrange a collection and send me the correct item as soon as possible.",
                    'replies' => [],
                    ],
                    [
                    'id' => '#T0479',
                    'customer' => 'Emma Davis',
                    'initials' => 'ED',
                    'email' => 'emma.davis@email.com',
                    'subject' => 'How do I track my package?',
                    'priority' => 'Medium',
                    'pbadge' => 'badge-medium',
                    'assigned' => 'Robert Lee',
                    'updated' => 'Jan 13, 2025',
                    'status' => 'Resolved',
                    'sbadge' => 'badge-resolved',
                    'order' => '#4519',
                    'created' => 'Jan 11, 2025 · 3:20 PM',
                    'message' => "Hi, I can't find where to track my package on the website. Order #4519 was placed 3 days ago and I'd like to know when it will arrive. Thanks.",
                    'replies' => [
                    ['from'=>'Robert Lee','role'=>'Support Agent','time'=>'Jan 11, 2025 · 4:00 PM','msg'=>"Hi Emma! You can track your order by visiting the 'My Orders' section in your account and clicking 'Track'. Your tracking number is FX928374651. Your package is currently in transit and expected to arrive Jan 15th.",'agent'=>true],
                    ['from'=>'Emma Davis','role'=>'Customer','time'=>'Jan 11, 2025 · 4:22 PM','msg'=>"Found it, thank you so much!",'agent'=>false],
                    ],
                    ],
                    [
                    'id' => '#T0478',
                    'customer' => 'Mike Torres',
                    'initials' => 'MT',
                    'email' => 'mike.torres@email.com',
                    'subject' => 'Coupon code not working',
                    'priority' => 'Medium',
                    'pbadge' => 'badge-medium',
                    'assigned' => 'Jane Smith',
                    'updated' => 'Jan 13, 2025',
                    'status' => 'Open',
                    'sbadge' => 'badge-pending',
                    'order' => '—',
                    'created' => 'Jan 13, 2025 · 1:10 PM',
                    'message' => "Hello, I'm trying to use the coupon code SAVE20 at checkout but it keeps saying 'Invalid or expired coupon'. I received this code via email last week and it should be valid until Jan 31st. Please help.",
                    'replies' => [],
                    ],
                    [
                    'id' => '#T0477',
                    'customer' => 'Anna Lee',
                    'initials' => 'AL',
                    'email' => 'anna.lee@email.com',
                    'subject' => 'Request for size exchange',
                    'priority' => 'Low',
                    'pbadge' => 'badge-low',
                    'assigned' => 'Unassigned',
                    'updated' => 'Jan 12, 2025',
                    'status' => 'Open',
                    'sbadge' => 'badge-pending',
                    'order' => '#4510',
                    'created' => 'Jan 12, 2025 · 10:55 AM',
                    'message' => "Hi, I bought a shirt in size L but I think M would fit better. I haven't worn it yet and it still has all tags. Is it possible to exchange it for a smaller size? I'm happy to ship it back.",
                    'replies' => [],
                    ],
                    ];
                    @endphp

                    @foreach($tickets as $t)
                    <tr>
                        <td style="padding-left:16px"><strong>{{ $t['id'] }}</strong></td>
                        <td style="font-size:12px">{{ $t['customer'] }}</td>
                        <td style="font-size:13px;max-width:180px">{{ $t['subject'] }}</td>
                        <td><span class="badge-status {{ $t['pbadge'] }}">{{ $t['priority'] }}</span></td>
                        <td style="font-size:12px">{{ $t['assigned'] }}</td>
                        <td style="font-size:12px;color:var(--text-muted)">{{ $t['updated'] }}</td>
                        <td><span class="badge-status {{ $t['sbadge'] }}">{{ $t['status'] }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-custom" style="font-size:11px;padding:3px 8px"
                                data-bs-toggle="modal" data-bs-target="#ticketModal"
                                data-ticket='@json($t)'>
                                View
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ══════════════════════════════════════════
     TICKET MODAL
══════════════════════════════════════════ -->
<div class="modal fade" id="ticketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header" style="border-bottom:1.5px solid var(--border)">
                <div>
                    <h6 class="modal-title fw-bold mb-1" id="ticketModalTitle">—</h6>
                    <div class="d-flex align-items-center gap-2 flex-wrap" id="ticketModalMeta"></div>
                </div>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" style="padding:0">

                <!-- Info Bar -->
                <div class="px-3 py-2 d-flex flex-wrap gap-3" style="background:var(--surface2);border-bottom:1.5px solid var(--border)" id="ticketInfoBar"></div>

                <!-- Conversation -->
                <div class="px-3 py-3 d-flex flex-column gap-3" id="ticketConversation"></div>

                <!-- Reply Box -->
                <div style="border-top:1.5px solid var(--border);padding:16px">
                    <p style="font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px">Reply to Customer</p>
                    <textarea id="ticketReplyBox" class="form-control" rows="4"
                        placeholder="Type your reply here…"
                        style="font-size:13px;resize:none"></textarea>
                    <div class="d-flex align-items-center justify-content-between mt-2 flex-wrap gap-2">
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" style="width:auto;font-size:12px" id="ticketStatusUpdate">
                                <option value="">Keep current status</option>
                                <option value="Open">Open</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Closed">Closed</option>
                            </select>
                            <select class="form-select form-select-sm" style="width:auto;font-size:12px">
                                <option>Assign: Robert Lee</option>
                                <option>Assign: Maria Garcia</option>
                                <option>Assign: Jane Smith</option>
                                <option>Unassigned</option>
                            </select>
                        </div>
                        <button class="btn btn-sm btn-primary-custom" id="sendReplyBtn">
                            <i class="bi bi-send me-1"></i>Send Reply
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('ticketModal').addEventListener('show.bs.modal', function(e) {
        const t = JSON.parse(e.relatedTarget.dataset.ticket);

        // ── Title & meta badges ──────────────────────────────
        document.getElementById('ticketModalTitle').textContent = t.id + ' · ' + t.subject;

        const priorityColors = {
            High: 'badge-high',
            Medium: 'badge-medium',
            Low: 'badge-low'
        };
        const statusColors = {
            'In Progress': 'badge-inprogress',
            Open: 'badge-pending',
            Resolved: 'badge-resolved',
            Closed: 'badge-draft'
        };

        document.getElementById('ticketModalMeta').innerHTML = `
        <span class="badge-status ${priorityColors[t.priority] ?? ''}" style="font-size:11px">${t.priority} Priority</span>
        <span class="badge-status ${statusColors[t.status]   ?? ''}" style="font-size:11px">${t.status}</span>
    `;

        // ── Info bar ─────────────────────────────────────────
        document.getElementById('ticketInfoBar').innerHTML = `
        <div style="font-size:12px"><span style="color:var(--text-muted)">Customer: </span><strong>${t.customer}</strong></div>
        <div style="font-size:12px"><span style="color:var(--text-muted)">Email: </span><strong>${t.email}</strong></div>
        <div style="font-size:12px"><span style="color:var(--text-muted)">Order: </span><strong>${t.order}</strong></div>
        <div style="font-size:12px"><span style="color:var(--text-muted)">Assigned: </span><strong>${t.assigned}</strong></div>
        <div style="font-size:12px"><span style="color:var(--text-muted)">Opened: </span><strong>${t.created}</strong></div>
    `;

        // ── Conversation thread ──────────────────────────────
        const conv = document.getElementById('ticketConversation');
        conv.innerHTML = '';

        // Original customer message
        conv.appendChild(buildBubble({
            from: t.customer,
            initials: t.initials,
            role: 'Customer',
            time: t.created,
            msg: t.message,
            agent: false,
        }));

        // Replies
        (t.replies ?? []).forEach(r => conv.appendChild(buildBubble(r)));

        // Reset reply box
        document.getElementById('ticketReplyBox').value = '';
        document.getElementById('ticketStatusUpdate').value = '';
    });

    // ── Build a chat bubble ──────────────────────────────────
    function buildBubble(r) {
        const wrap = document.createElement('div');
        wrap.className = 'd-flex gap-3 ' + (r.agent ? 'flex-row-reverse' : '');

        const avatarBg = r.agent ? 'var(--primary-light)' : '#f3e8ff';
        const avatarColor = r.agent ? 'var(--primary)' : '#7c3aed';
        const initials = r.initials ?? r.from.split(' ').map(w => w[0]).join('').slice(0, 2).toUpperCase();
        const bubbleBg = r.agent ? 'var(--primary-light)' : 'var(--surface2)';
        const bubbleBorder = r.agent ? 'var(--primary)' : 'var(--border)';
        const align = r.agent ? 'text-end' : '';

        wrap.innerHTML = `
        <div style="width:36px;height:36px;border-radius:50%;background:${avatarBg};color:${avatarColor};display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0">
            ${initials}
        </div>
        <div style="max-width:80%;flex:1" class="${align}">
            <div class="d-flex align-items-center gap-2 mb-1 ${r.agent ? 'justify-content-end' : ''}">
                <span style="font-size:12px;font-weight:700">${r.from}</span>
                <span style="font-size:11px;color:var(--text-muted)">${r.role}</span>
                <span style="font-size:11px;color:var(--text-muted)">· ${r.time}</span>
            </div>
            <div style="background:${bubbleBg};border:1.5px solid ${bubbleBorder};border-radius:${r.agent ? '12px 4px 12px 12px' : '4px 12px 12px 12px'};padding:10px 14px;font-size:13px;line-height:1.7;color:var(--text-secondary)">
                ${r.msg}
            </div>
        </div>`;
        return wrap;
    }

    // ── Send reply (append bubble) ───────────────────────────
    document.getElementById('sendReplyBtn').addEventListener('click', function() {
        const box = document.getElementById('ticketReplyBox');
        const msg = box.value.trim();
        if (!msg) return;

        const conv = document.getElementById('ticketConversation');
        const now = new Date().toLocaleString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: '2-digit'
        });

        conv.appendChild(buildBubble({
            from: 'You (Admin)',
            role: 'Support Agent',
            time: now,
            msg: msg,
            agent: true,
        }));

        box.value = '';
        conv.lastElementChild.scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>

@endsection