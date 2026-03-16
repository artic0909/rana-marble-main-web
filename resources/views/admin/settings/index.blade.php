@extends('admin.layout.app')

@section('title', 'Account Settings')

@section('content')

<!-- ══ 21. SETTINGS ══ -->
<section class="page-section active" id="page-settings">
    <div class="mb-4">
        <h1 class="page-title">Settings</h1>
        <p class="page-subtitle">Configure your store preferences.</p>
    </div>
    <div class="row g-3">
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-body p-2">
                    <nav class="settings-nav nav flex-column gap-1">
                        <a class="nav-link active" href="#" onclick="showSettingsTab('general',this)"><i
                                class="bi bi-gear me-2"></i>General</a>

                        <a class="nav-link" href="#" onclick="showSettingsTab('store',this)"><i
                                class="bi bi-shop me-2"></i>Store Info</a>

                        <!-- <a class="nav-link" href="#" onclick="showSettingsTab('payment',this)"><i
                                class="bi bi-credit-card me-2"></i>Payment</a>

                        <a class="nav-link" href="#" onclick="showSettingsTab('tax',this)"><i
                                class="bi bi-percent me-2"></i>Tax & VAT</a>

                        <a class="nav-link" href="#" onclick="showSettingsTab('notifications',this)"><i
                                class="bi bi-bell me-2"></i>Notifications</a> -->

                        <a class="nav-link" href="#" onclick="showSettingsTab('security',this)"><i
                                class="bi bi-shield-lock me-2"></i>Security</a>

                        <!-- <a class="nav-link" href="#" onclick="showSettingsTab('integrations',this)"><i
                                class="bi bi-plug me-2"></i>Integrations</a> -->

                        <a class="nav-link" href="#" onclick="showSettingsTab('seo',this)"><i
                                class="bi bi-search me-2"></i>SEO</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
            <!-- General -->
            <div class="card settings-tab" id="settab-general">
                <div class="card-body">
                    <h6 class="card-title-sm mb-4">General Settings</h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-6"><label class="form-label-custom">Store Name</label><input type="text"
                                class="form-control" value="ShopNest"></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Store Email</label><input type="email"
                                class="form-control" value="hello@shopnest.com"></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Currency</label><select
                                class="form-select">
                                <option>USD — US Dollar</option>
                                <option>EUR — Euro</option>
                                <option>GBP — British Pound</option>
                                <option>INR — Indian Rupee</option>
                            </select></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Timezone</label><select
                                class="form-select">
                                <option>UTC-5 Eastern Time</option>
                                <option>UTC-8 Pacific Time</option>
                                <option>UTC+0 GMT</option>
                                <option>UTC+5:30 IST</option>
                            </select></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Language</label><select
                                class="form-select">
                                <option>English (US)</option>
                                <option>Spanish</option>
                                <option>French</option>
                                <option>German</option>
                            </select></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Date Format</label><select
                                class="form-select">
                                <option>MM/DD/YYYY</option>
                                <option>DD/MM/YYYY</option>
                                <option>YYYY-MM-DD</option>
                            </select></div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                                style="border:1.5px solid var(--border)">
                                <div>
                                    <div style="font-weight:600;font-size:14px">Maintenance Mode</div>
                                    <div style="font-size:12px;color:var(--text-muted)">Put store in maintenance mode</div>
                                </div>
                                <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox"
                                        style="width:40px;height:20px"></div>
                            </div>
                        </div>
                        <div class="col-12"><button class="btn btn-primary-custom">Save Changes</button></div>
                    </div>
                </div>
            </div>
            <!-- Store Info -->
            <div class="card settings-tab d-none" id="settab-store">
                <div class="card-body">
                    <h6 class="card-title-sm mb-4">Store Information</h6>
                    <div class="mb-3"><label class="form-label-custom">Store Logo</label>
                        <div class="d-flex align-items-center gap-3">
                            <div
                                style="width:64px;height:64px;border-radius:14px;background:var(--primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:24px">
                                <i class="bi bi-bag-heart-fill"></i>
                            </div><button class="btn btn-outline-custom btn-sm">Change
                                Logo</button>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label-custom">Store Description</label><textarea
                                class="form-control" rows="3">Your one-stop shop for premium products at great prices.</textarea>
                        </div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Phone</label><input type="text"
                                class="form-control" value="+1 (555) 123-4567"></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Website</label><input type="text"
                                class="form-control" value="https://shopnest.com"></div>
                        <div class="col-12"><label class="form-label-custom">Address</label><textarea class="form-control"
                                rows="2">123 Commerce St, New York, NY 10001</textarea></div>
                        <div class="col-12"><button class="btn btn-primary-custom">Save Changes</button></div>
                    </div>
                </div>
            </div>
            <!-- Payment Settings -->
            <div class="card settings-tab d-none" id="settab-payment">
                <div class="card-body">
                    <h6 class="card-title-sm mb-4">Payment Settings</h6>
                    <div class="d-flex flex-column gap-3">
                        <div class="p-3 rounded-3" style="border:1.5px solid var(--border)">
                            <div class="d-flex justify-content-between align-items-center mb-2"><strong
                                    style="font-size:14px">Stripe</strong>
                                <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-12"><label class="form-label-custom" style="font-size:11px">Publishable
                                        Key</label><input type="text" class="form-control" style="font-size:12px"
                                        value="pk_live_••••••••••••••••"></div>
                                <div class="col-12"><label class="form-label-custom" style="font-size:11px">Secret
                                        Key</label><input type="password" class="form-control" style="font-size:12px"
                                        value="sk_live_••••••••••••••••"></div>
                            </div>
                        </div>
                        <div class="p-3 rounded-3" style="border:1.5px solid var(--border)">
                            <div class="d-flex justify-content-between align-items-center mb-2"><strong
                                    style="font-size:14px">PayPal</strong>
                                <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-12"><label class="form-label-custom" style="font-size:11px">Client
                                        ID</label><input type="text" class="form-control" style="font-size:12px"
                                        value="AX••••••••••••••••"></div>
                            </div>
                        </div>
                        <button class="btn btn-primary-custom">Save Payment Settings</button>
                    </div>
                </div>
            </div>
            <!-- Tax -->
            <div class="card settings-tab d-none" id="settab-tax">
                <div class="card-body">
                    <h6 class="card-title-sm mb-4">Tax & VAT Settings</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                                style="border:1.5px solid var(--border)">
                                <div>
                                    <div style="font-weight:600;font-size:14px">Enable Tax Calculation</div>
                                </div>
                                <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Default Tax Rate (%)</label><input
                                type="number" class="form-control" value="8.5"></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Tax Calculation</label><select
                                class="form-select">
                                <option>Based on shipping address</option>
                                <option>Based on billing address</option>
                            </select></div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                                style="border:1.5px solid var(--border)">
                                <div>
                                    <div style="font-weight:600;font-size:14px">Display prices with tax</div>
                                </div>
                                <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox"></div>
                            </div>
                        </div>
                        <div class="col-12"><button class="btn btn-primary-custom">Save Tax Settings</button></div>
                    </div>
                </div>
            </div>
            <!-- Notifications -->
            <div class="card settings-tab d-none" id="settab-notifications">
                <div class="card-body">
                    <h6 class="card-title-sm mb-4">Notification Preferences</h6>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-weight:600;font-size:14px">New Order</div>
                                <div style="font-size:12px;color:var(--text-muted)">Get notified for every new order</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-weight:600;font-size:14px">Low Stock Alert</div>
                                <div style="font-size:12px;color:var(--text-muted)">Alert when stock goes below threshold</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-weight:600;font-size:14px">New Review</div>
                                <div style="font-size:12px;color:var(--text-muted)">Notification for every new review</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-weight:600;font-size:14px">Support Ticket</div>
                                <div style="font-size:12px;color:var(--text-muted)">Alert for new support tickets</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-weight:600;font-size:14px">Payment Failed</div>
                                <div style="font-size:12px;color:var(--text-muted)">Alert when a payment fails</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-weight:600;font-size:14px">Weekly Summary</div>
                                <div style="font-size:12px;color:var(--text-muted)">Email digest every Monday</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox"></div>
                        </div>
                        <button class="btn btn-primary-custom">Save Preferences</button>
                    </div>
                </div>
            </div>
            <!-- Security -->
            <div class="card settings-tab d-none" id="settab-security">
                <div class="card-body">
                    <h6 class="card-title-sm mb-4">Security Settings</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <h6 style="font-size:14px;font-weight:700">Change Password</h6>
                        </div>
                        <div class="col-12"><label class="form-label-custom">Current Password</label><input type="password"
                                class="form-control" placeholder="••••••••"></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">New Password</label><input
                                type="password" class="form-control" placeholder="••••••••"></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Confirm Password</label><input
                                type="password" class="form-control" placeholder="••••••••"></div>
                        <div class="col-12"><button class="btn btn-primary-custom">Update Password</button></div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <h6 style="font-size:14px;font-weight:700">Two-Factor Authentication</h6>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                                style="border:1.5px solid var(--border)">
                                <div>
                                    <div style="font-weight:600;font-size:14px">Enable 2FA</div>
                                    <div style="font-size:12px;color:var(--text-muted)">Use authenticator app for extra security
                                    </div>
                                </div><button class="btn btn-sm btn-primary-custom">Setup 2FA</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                                style="border:1.5px solid var(--border)">
                                <div>
                                    <div style="font-weight:600;font-size:14px">Login Activity</div>
                                    <div style="font-size:12px;color:var(--text-muted)">Last login: Jan 14, 2025 · New York, US
                                    </div>
                                </div><button class="btn btn-sm btn-outline-custom">View All</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Integrations -->
            <div class="card settings-tab d-none" id="settab-integrations">
                <div class="card-body">
                    <h6 class="card-title-sm mb-4">Integrations</h6>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div class="d-flex align-items-center gap-3"><span style="font-size:26px">📊</span>
                                <div>
                                    <div style="font-weight:600;font-size:14px">Google Analytics</div>
                                    <div style="font-size:12px;color:var(--text-muted)">Track visitors and conversions</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2"><span
                                    class="badge-status badge-active">Connected</span><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px">Configure</button></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div class="d-flex align-items-center gap-3"><span style="font-size:26px">📦</span>
                                <div>
                                    <div style="font-weight:600;font-size:14px">Mailchimp</div>
                                    <div style="font-size:12px;color:var(--text-muted)">Email marketing automation</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2"><span
                                    class="badge-status badge-active">Connected</span><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px">Configure</button></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div class="d-flex align-items-center gap-3"><span style="font-size:26px">💬</span>
                                <div>
                                    <div style="font-weight:600;font-size:14px">Intercom</div>
                                    <div style="font-size:12px;color:var(--text-muted)">Customer support chat</div>
                                </div>
                            </div><button class="btn btn-sm btn-primary-custom" style="font-size:11px">Connect</button>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div class="d-flex align-items-center gap-3"><span style="font-size:26px">📱</span>
                                <div>
                                    <div style="font-weight:600;font-size:14px">Facebook Pixel</div>
                                    <div style="font-size:12px;color:var(--text-muted)">Ad tracking & retargeting</div>
                                </div>
                            </div><button class="btn btn-sm btn-primary-custom" style="font-size:11px">Connect</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SEO -->
            <div class="card settings-tab d-none" id="settab-seo">
                <div class="card-body">
                    <h6 class="card-title-sm mb-4">SEO Settings</h6>
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label-custom">Meta Title</label><input type="text"
                                class="form-control" value="ShopNest — Premium Online Store"></div>
                        <div class="col-12"><label class="form-label-custom">Meta Description</label><textarea
                                class="form-control"
                                rows="3">Shop the best products at unbeatable prices. Free shipping on orders over $50.</textarea>
                        </div>
                        <div class="col-12"><label class="form-label-custom">Keywords</label><input type="text"
                                class="form-control" placeholder="online store, buy, shop, deals"></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">OG Image URL</label><input type="text"
                                class="form-control" placeholder="https://..."></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Robots.txt</label><select
                                class="form-select">
                                <option>Index, Follow</option>
                                <option>No Index</option>
                                <option>No Follow</option>
                            </select></div>
                        <div class="col-12"><label class="form-label-custom">Google Verification Code</label><input
                                type="text" class="form-control" placeholder="google-site-verification=..."></div>
                        <div class="col-12"><button class="btn btn-primary-custom">Save SEO Settings</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection