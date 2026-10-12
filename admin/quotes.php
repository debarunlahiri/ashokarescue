<?php
/**
 * Admin Quotes Management
 */

require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

// Check if logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

// Get all quotes from all three tables
$homeQuotes = getAll("SELECT 'home' as type, id, email as name, departing_from, destination, services, contact_no, created_at FROM home_quotes ORDER BY created_at DESC");
$footerQuotes = getAll("SELECT 'footer' as type, id, name, email, phone, services, details, created_at FROM home_footer_quotes ORDER BY created_at DESC");
$contactQuotes = getAll("SELECT 'contact' as type, id, name, email, services, details, created_at FROM contact_quotes ORDER BY created_at DESC");

// Merge all quotes
$allQuotes = array_merge($homeQuotes, $footerQuotes, $contactQuotes);

// Sort by created_at
usort($allQuotes, function ($a, $b) {
    return strtotime($b['created_at']) - strtotime($a['created_at']);
});

$pageTitle = 'Quotes Management';
$activePage = 'quotes';
$additionalStyles = '<style>
    .badge-type {
        font-size: 0.75rem;
        padding: 4px 8px;
    }
</style>';

require_once __DIR__ . '/includes/header.php';
?>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-envelope"></i> Quote Requests</h2>
                    <a href="dashboard.php" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>

                <!-- Statistics -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5>Home Quotes</h5>
                                <h3>
                                    <?php echo count($homeQuotes); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5>Footer Quotes</h5>
                                <h3>
                                    <?php echo count($footerQuotes); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5>Contact Quotes</h5>
                                <h3>
                                    <?php echo count($contactQuotes); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quotes Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">All Quote Requests</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Name/Email</th>
                                        <th>Service</th>
                                        <th>Details</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($allQuotes)): ?>
                                        <?php foreach ($allQuotes as $quote): ?>
                                            <tr>
                                                <td>
                                                    <?php if ($quote['type'] === 'home'): ?>
                                                        <span class="badge bg-primary badge-type">Home</span>
                                                    <?php elseif ($quote['type'] === 'footer'): ?>
                                                        <span class="badge bg-success badge-type">Footer</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-info badge-type">Contact</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <strong>
                                                        <?php echo htmlspecialchars($quote['name'] ?? $quote['email']); ?>
                                                    </strong><br>
                                                    <?php if (isset($quote['email']) && $quote['email'] !== $quote['name']): ?>
                                                        <small class="text-muted">
                                                            <?php echo htmlspecialchars($quote['email']); ?>
                                                        </small>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($quote['services']); ?>
                                                </td>
                                                <td>
                                                    <?php if ($quote['type'] === 'home'): ?>
                                                        <small>
                                                            From:
                                                            <?php echo htmlspecialchars($quote['departing_from']); ?><br>
                                                            To:
                                                            <?php echo htmlspecialchars($quote['destination']); ?><br>
                                                            Contact:
                                                            <?php echo htmlspecialchars($quote['contact_no']); ?>
                                                        </small>
                                                    <?php elseif (isset($quote['details'])): ?>
                                                        <small>
                                                            <?php echo truncateText($quote['details'], 50); ?>
                                                        </small>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <small>
                                                        <?php echo formatDate($quote['created_at'], 'd M Y H:i'); ?>
                                                    </small>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No quotes yet</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
