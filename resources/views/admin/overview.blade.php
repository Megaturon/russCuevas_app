<div style="background-color: #111111; color: #ffffff; padding: 40px; border-radius: 12px; margin-bottom: 20px; position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
    <div style="position: relative; z-index: 2;">
        <h2 style="font-family: var(--font-sans); font-size: 2rem; margin-bottom: 10px; font-weight: 700;">Welcome to Administrator Dashboard</h2>
        <p style="color: #888888; font-size: 0.95rem; margin-bottom: 0;">The best place for premium tailoring administration and oversight.</p>
    </div>
</div>

<div class="stats-grid-modern">
    <!-- Revenue Card -->
    <div class="stat-card-v2">
        <div class="card-info">
            <span class="card-label-v2">Pending Revenue</span>
            <div class="card-value-container">
                <span class="currency-v2">₱</span>
                <span class="value-v2">{{ number_format($totalRevenuePending, 0) }}</span>
            </div>
            <div class="card-meta">
                <span class="trend-indicator {{ $revenueGrowthWeek >= 0 ? 'up' : 'down' }}">
                    <i class="fas fa-caret-{{ $revenueGrowthWeek >= 0 ? 'up' : 'down' }}"></i> {{ abs($revenueGrowthWeek) }}%
                </span>
                <span class="meta-label">vs last week</span>
            </div>
        </div>
        <div class="sparkline-wrapper">
            <canvas id="sparkline-revenue"></canvas>
        </div>
    </div>

    <!-- Quotes Card -->
    <div class="stat-card-v2">
        <div class="card-info">
            <span class="card-label-v2">Total Quotes</span>
            <div class="card-value-container">
                <span class="value-v2">{{ number_format($quotes->count()) }}</span>
            </div>
            <div class="card-meta">
                <span class="trend-indicator {{ $quotesGrowthWeek >= 0 ? 'up' : 'down' }}">
                    <i class="fas fa-caret-{{ $quotesGrowthWeek >= 0 ? 'up' : 'down' }}"></i> {{ abs($quotesGrowthWeek) }}%
                </span>
                <span class="meta-label">vs last week</span>
            </div>
        </div>
        <div class="sparkline-wrapper">
            <canvas id="sparkline-quotes"></canvas>
        </div>
    </div>

    <!-- Appointments Card -->
    <div class="stat-card-v2">
        <div class="card-info">
            <span class="card-label-v2">Appointments</span>
            <div class="card-value-container">
                <span class="value-v2">{{ number_format($appointments->count()) }}</span>
            </div>
            <div class="card-meta">
                <span class="trend-indicator {{ $appsGrowthWeek >= 0 ? 'up' : 'down' }}">
                    <i class="fas fa-caret-{{ $appsGrowthWeek >= 0 ? 'up' : 'down' }}"></i> {{ abs($appsGrowthWeek) }}%
                </span>
                <span class="meta-label">vs last week</span>
            </div>
        </div>
        <div class="sparkline-wrapper">
            <canvas id="sparkline-apps"></canvas>
        </div>
    </div>

    <!-- Conversion Card -->
    <div class="stat-card-v2">
        <div class="card-info">
            <span class="card-label-v2">Conversion Rate</span>
            <div class="card-value-container">
                <span class="value-v2">{{ $conversionRate }}%</span>
            </div>
            <div class="card-meta">
                <span class="trend-indicator {{ $convGrowthWeek >= 0 ? 'up' : 'down' }}">
                    <i class="fas fa-caret-{{ $convGrowthWeek >= 0 ? 'up' : 'down' }}"></i> {{ abs($convGrowthWeek) }}%
                </span>
                <span class="meta-label">vs last week</span>
            </div>
        </div>
        <div class="sparkline-wrapper">
            <canvas id="sparkline-conv"></canvas>
        </div>
    </div>
</div>

<div class="analytics-layout">
    <!-- Main Traffic Chart -->
    <div class="analytics-panel traffic-panel">
        <div class="panel-header">
            <h3>Weekly Inbound Traffic</h3>
            <div class="panel-actions">
                <span class="data-period">Last 7 Days</span>
            </div>
        </div>
        <div class="main-chart-wrapper">
            <canvas id="mainInboundChart"></canvas>
        </div>
    </div>

    <!-- Status Breakdown -->
    <div class="analytics-panel status-panel">
        <div class="panel-header">
            <h3>Appointment Status Distribution</h3>
        </div>
        <div class="status-chart-wrapper">
            <canvas id="appointmentStatusDonut"></canvas>
        </div>
    </div>
</div>

<div class="bottom-sections">
    <!-- Activity Timeline -->
    <div class="activity-feed-modern">
        <div class="panel-header">
            <h3>System Activity</h3>
        </div>
        <div class="modern-timeline">
            @foreach($recentActivities as $activity)
            <div class="timeline-row">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <div class="timeline-main">
                        <span class="activity-user">{{ $activity->name }}</span>
                        <span class="activity-text">
                            @if($activity->activity_type == 'Quote')
                            requested a quote for <strong>{{ $activity->service_type }}</strong>
                            @else
                            booked a <strong>consultation</strong> session
                            @endif
                        </span>
                    </div>
                    <div class="timeline-meta">
                        {{ $activity->created_at->diffForHumans() }}
                        <span class="dot-separator">•</span>
                        <span class="activity-tag {{ strtolower($activity->activity_type) }}">{{ $activity->activity_type }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Ranked Services -->
    <div class="analytics-panel service-panel">
        <div class="panel-header">
            <h3>Top Requested Services</h3>
        </div>
        <div class="ranked-list">
            @foreach($serviceDistribution->take(5) as $index => $service)
            <div class="ranked-item">
                <div class="ranked-info">
                    <span class="service-name">{{ $service->service_type }}</span>
                    <span class="service-count">{{ $service->total }} requests</span>
                </div>
                <div class="rank-bar-container">
                    <div class="rank-bar" style="width: {{ ($service->total / ($serviceDistribution->first()->total ?: 1)) * 100 }}%; background: {{ $index % 2 == 0 ? '#111111' : '#888888' }};"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    :root {
        --accent: #111111;
        --accent-light: #e5e5e5;
        --border-color: #e5e5e5;
        --text-main: #111111;
        --text-muted: #888888;
        --success: #111111;
        --error: #888888;
    }

    .overview-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 35px;
    }

    .date-badge {
        padding: 8px 16px;
        border: 1px solid var(--accent);
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Modern Stats Grid */
    .stats-grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card-v2 {
        background: #fff;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border-radius: 12px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .stat-card-v2:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    }

    .card-label-v2 {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        display: block;
        margin-bottom: 12px;
    }

    .card-value-container {
        display: flex;
        align-items: baseline;
        gap: 4px;
        margin-bottom: 8px;
    }

    .currency-v2 {
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-muted);
    }

    .value-v2 {
        font-family: var(--font-sans);
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -1px;
        line-height: 1;
    }

    .card-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.75rem;
    }

    .trend-indicator {
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .trend-indicator.up { color: var(--accent); }
    .trend-indicator.down { color: var(--text-muted); }

    .meta-label {
        color: var(--text-muted);
    }

    .sparkline-wrapper {
        height: 40px;
        margin-top: 15px;
    }

    /* Analytics Layout */
    .analytics-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .analytics-panel {
        background: #fff;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border-radius: 12px;
        padding: 30px;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .panel-header h3 {
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .data-period {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--text-muted);
        padding: 4px 10px;
        background: var(--accent-light);
    }

    .main-chart-wrapper {
        height: 350px;
    }

    /* Ranked List */
    .ranked-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .ranked-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .ranked-info {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
    }

    .service-name {
        font-weight: 600;
        color: var(--text-main);
    }

    .service-count {
        color: var(--text-muted);
        font-size: 0.75rem;
    }

    .rank-bar-container {
        height: 6px;
        background: var(--accent-light);
        width: 100%;
    }

    .rank-bar {
        height: 100%;
        background: var(--accent);
    }

    /* Bottom Sections */
    .bottom-sections {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .activity-feed-modern {
        background: #fff;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border-radius: 12px;
        padding: 30px;
    }

    .modern-timeline {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .timeline-row {
        display: flex;
        gap: 20px;
        position: relative;
    }

    .timeline-marker {
        width: 12px;
        height: 12px;
        border: 2px solid var(--accent);
        background: #fff;
        border-radius: 50%;
        position: relative;
        z-index: 2;
        margin-top: 6px;
    }

    .timeline-row::after {
        content: '';
        position: absolute;
        left: 5px;
        top: 18px;
        width: 1px;
        height: calc(100% - 12px);
        background: var(--border-color);
        z-index: 1;
    }

    .timeline-row:last-child::after {
        display: none;
    }

    .timeline-content {
        flex: 1;
        padding-bottom: 25px;
    }

    .timeline-main {
        font-size: 0.9rem;
        line-height: 1.4;
        margin-bottom: 5px;
    }

    .activity-user {
        font-weight: 700;
        color: var(--text-main);
    }

    .activity-text {
        color: var(--text-muted);
    }

    .timeline-meta {
        font-size: 0.75rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .activity-tag {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 10px;
        letter-spacing: 0.5px;
    }

    .activity-tag.quote { 
        background: transparent; 
        color: #888; 
        border: 1px solid #888; 
        border-radius: 4px;
    }
    
    .activity-tag.appointment { 
        background: #111; 
        color: #fff; 
        border: 1px solid #111; 
        border-radius: 20px; /* inverted pill */
    }

    .status-chart-wrapper {
        height: 250px;
    }

    @media (max-width: 1024px) {
        .analytics-layout, .bottom-sections {
            grid-template-columns: 1fr;
        }
    }
</style>
