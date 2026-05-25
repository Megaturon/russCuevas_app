@extends('layouts.portal')

@section('title', 'Account Settings')

@section('content')
<style>
    .site-footer { display: none !important; }
    body {
        background-color: #f4f7f6;
    }
    .settings-wrapper {
        display: flex;
        justify-content: center;
        padding: 40px 20px;
    }
    .settings-container {
        display: flex;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        max-width: 950px;
        width: 100%;
        min-height: 600px;
        overflow: hidden;
    }
    .settings-sidebar {
        width: 280px;
        border-right: 1px solid #f0f0f0;
        background: #fafbfc;
        display: flex;
        flex-direction: column;
    }
    .profile-photo-container {
        padding: 40px 20px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .profile-photo {
        width: 150px;
        height: 150px;
        background: #111;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .profile-photo-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.4);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        opacity: 0;
        transition: 0.3s;
        cursor: pointer;
    }
    .profile-photo:hover .profile-photo-overlay {
        opacity: 1;
    }
    .settings-nav {
        margin-top: 20px;
    }
    .settings-nav-item {
        padding: 16px 30px;
        cursor: pointer;
        font-weight: 600;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: 0.2s;
        border-left: 4px solid transparent;
    }
    .settings-nav-item i {
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }
    .settings-nav-item:hover {
        background: #f1f5f9;
        color: #334155;
    }
    .settings-nav-item.active {
        background: #f8fafc;
        color: #2563eb;
        border-left-color: #2563eb;
    }
    .settings-content {
        flex: 1;
        padding: 50px 60px;
        background: #ffffff;
    }
    .settings-section {
        display: none;
    }
    .settings-section.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 30px;
        font-family: var(--font-inter, sans-serif);
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }
    .form-group label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #94a3b8;
        margin-bottom: 8px;
    }
    .form-group input, .form-group textarea {
        background: #f8fafc;
        border: 1px solid transparent;
        color: #334155;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: 0.2s;
        width: 100%;
        box-sizing: border-box;
    }
    .form-group input:focus, .form-group textarea:focus {
        border-color: #cbd5e1;
        outline: none;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }
    .form-group input:disabled {
        color: #94a3b8;
        cursor: not-allowed;
    }
    .btn-update {
        background: #111;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s;
        margin-top: 10px;
    }
    .btn-update:hover {
        background: #333;
        transform: translateY(-1px);
    }
    .input-wrapper {
        position: relative;
        display: block;
    }
    .input-wrapper i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: auto;
        cursor: pointer;
        padding: 5px;
    }
    .input-wrapper textarea + i {
        top: 22px;
    }
    .input-wrapper input, .input-wrapper textarea {
        padding-right: 40px !important;
    }
    .btn-update:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-weight: 500;
        font-size: 0.9rem;
    }
    .alert-success { background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
    .alert-error { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    /* Payment Methods styles */
    .payment-card {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        border-radius: 16px;
        padding: 25px;
        color: white;
        width: 300px;
        box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
        position: relative;
        overflow: hidden;
    }
    .payment-card::after {
        content: '';
        position: absolute;
        top: -50%; right: -50%;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .card-chip {
        width: 45px; height: 35px;
        background: #fbbf24;
        border-radius: 6px;
        margin-bottom: 20px;
        opacity: 0.9;
    }
    .card-number {
        font-size: 1.4rem;
        letter-spacing: 2px;
        margin-bottom: 20px;
        font-family: monospace;
    }
    .card-details {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.8;
    }
</style>

<div class="settings-wrapper">
    <div class="settings-container">
        <!-- Sidebar -->
        <div class="settings-sidebar">
            <div class="profile-photo-container">
                <div class="profile-photo">
                    @php
                        $nameParts = explode(' ', trim($user->name));
                        $initials = strtoupper(substr($nameParts[0], 0, 1));
                        if(count($nameParts) > 1) {
                            $initials .= strtoupper(substr(end($nameParts), 0, 1));
                        }
                    @endphp
                    {{ $initials }}
                    <div class="profile-photo-overlay">
                        <i class="fas fa-camera" style="font-size: 1.5rem; margin-bottom: 5px;"></i>
                        <span>Click to change photo</span>
                    </div>
                </div>
                <h3 style="margin-top: 15px; color: #334155; font-weight: 700;">{{ explode(' ', $user->name)[0] }}</h3>
            </div>
            
            <div class="settings-nav">
                <div class="settings-nav-item active" onclick="switchTab('account-details', this)">
                    <i class="far fa-file-alt"></i> Account Details
                </div>
                <div class="settings-nav-item" onclick="switchTab('payment-methods', this)">
                    <i class="far fa-credit-card"></i> Payment methods
                </div>
                <div class="settings-nav-item" onclick="switchTab('password-settings', this)">
                    <i class="fas fa-lock"></i> Password
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="settings-content">
            @if(session('success'))
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Account Details Section -->
            <div id="account-details" class="settings-section active">
                <h2 class="section-title">Account Details</h2>
                <form action="{{ route('portal.settings.profile') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label>Full Name: *</label>
                            <div class="input-wrapper">
                                <input type="text" name="name" value="{{ $user->name }}" required readonly id="input-name">
                                <i class="fas fa-pencil-alt" onclick="document.getElementById('input-name').removeAttribute('readonly'); document.getElementById('input-name').focus();"></i>
                            </div>
                        </div>
                        <div class="form-group full-width">
                            <label>E-Mail: *</label>
                            <input type="email" value="{{ $user->email }}" disabled title="Email is your primary login identifier.">
                        </div>
                        <div class="form-group full-width">
                            <label>Contact Number:</label>
                            <div class="input-wrapper">
                                <input type="text" name="contact" value="{{ $user->contact }}" readonly id="input-contact">
                                <i class="fas fa-pencil-alt" onclick="document.getElementById('input-contact').removeAttribute('readonly'); document.getElementById('input-contact').focus();"></i>
                            </div>
                        </div>
                        <div class="form-group full-width">
                            <label>Address:</label>
                            <div class="input-wrapper">
                                <textarea name="address" rows="3" readonly id="input-address">{{ $user->address }}</textarea>
                                <i class="fas fa-pencil-alt" onclick="document.getElementById('input-address').removeAttribute('readonly'); document.getElementById('input-address').focus();"></i>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: right; margin-top: 10px;">
                        <button type="submit" class="btn-update">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>

            <!-- Payment Methods Section -->
            <div id="payment-methods" class="settings-section">
                <h2 class="section-title">Payment Methods</h2>
                <p style="color: #64748b; margin-bottom: 30px;">Manage your saved payment methods for faster checkout.</p>
                
                <div class="payment-card">
                    <div class="card-chip"></div>
                    <div class="card-number">**** **** **** 1234</div>
                    <div class="card-details">
                        <div>
                            <div style="font-size: 0.6rem; opacity: 0.7;">Card Holder</div>
                            <div>{{ strtoupper($user->name) }}</div>
                        </div>
                        <div>
                            <div style="font-size: 0.6rem; opacity: 0.7;">Expires</div>
                            <div>12/28</div>
                        </div>
                    </div>
                </div>
                
                <div style="margin-top: 30px;" id="add-payment-btn-container">
                    <button type="button" class="btn-update" style="background: #f1f5f9; color: #334155;" onclick="document.getElementById('add-payment-options').style.display='block'; this.parentElement.style.display='none';">
                        <i class="fas fa-plus"></i> Add Payment Method
                    </button>
                </div>

                <div id="add-payment-options" style="display: none; margin-top: 30px; background: #f8fafc; padding: 25px; border-radius: 12px; border: 1px dashed #cbd5e1;">
                    <h4 style="margin-top: 0; color: #334155; font-size: 1.1rem; margin-bottom: 20px; font-weight: 600;">Link an e-Wallet Account</h4>
                    <div style="display: flex; gap: 15px;">
                        <button type="button" style="flex: 1; padding: 20px; background: white; border: 1px solid #e2e8f0; border-radius: 10px; cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; transition: 0.2s;" onmouseover="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.1)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';" onclick="alert('GCash linking flow would initiate here.')">
                            <i class="fas fa-wallet" style="font-size: 2rem; color: #2563eb; margin-bottom: 5px;"></i>
                            <span style="font-weight: 600; color: #334155; font-size: 0.95rem;">Link GCash</span>
                        </button>
                        <button type="button" style="flex: 1; padding: 20px; background: white; border: 1px solid #e2e8f0; border-radius: 10px; cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; transition: 0.2s;" onmouseover="this.style.borderColor='#10b981'; this.style.boxShadow='0 4px 12px rgba(16,185,129,0.1)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';" onclick="alert('Maya linking flow would initiate here.')">
                            <i class="fas fa-qrcode" style="font-size: 2rem; color: #10b981; margin-bottom: 5px;"></i>
                            <span style="font-weight: 600; color: #334155; font-size: 0.95rem;">Link Maya</span>
                        </button>
                    </div>
                    <div style="text-align: center; margin-top: 20px;">
                        <button type="button" style="background: none; border: none; color: #64748b; font-size: 0.9rem; cursor: pointer; padding: 5px 15px; font-weight: 500; transition: 0.2s;" onmouseover="this.style.color='#334155'" onmouseout="this.style.color='#64748b'" onclick="document.getElementById('add-payment-options').style.display='none'; document.getElementById('add-payment-btn-container').style.display='block';">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Password Section -->
            <div id="password-settings" class="settings-section">
                <h2 class="section-title">Password Settings</h2>
                
                <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; background: #f8fafc; padding: 20px; border-radius: 8px;">
                    <div>
                        <div style="font-size: 0.85rem; color: #64748b; font-weight: 600; margin-bottom: 5px;">Current Password</div>
                        <div style="font-size: 1.5rem; letter-spacing: 4px; color: #334155;">••••••••••••</div>
                    </div>
                    <div style="text-align: right; font-size: 0.85rem; color: #94a3b8;">
                        Last updated<br>
                        <strong>{{ $user->updated_at ? $user->updated_at->format('M d, Y') : 'N/A' }}</strong>
                    </div>
                </div>

                <form action="{{ route('portal.settings.password') }}" method="POST">
                    @csrf
                    <div class="form-group full-width">
                        <label>Current Password: *</label>
                        <input type="password" name="current_password" required>
                    </div>
                    <div class="form-group full-width">
                        <label>New Password: *</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-group full-width">
                        <label>Confirm New Password: *</label>
                        <input type="password" name="password_confirmation" required>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                        <a href="{{ route('password.request') }}" style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Forgot Password?</a>
                        <button type="submit" class="btn-update" style="margin-top: 0;">
                            <i class="fas fa-save"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tabId, element) {
        document.querySelectorAll('.settings-section').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.settings-nav-item').forEach(el => el.classList.remove('active'));
        
        document.getElementById(tabId).classList.add('active');
        element.classList.add('active');
    }

</script>
@endsection
