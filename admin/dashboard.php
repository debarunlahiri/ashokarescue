<?php
/**
 * Admin Dashboard
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

// Get statistics
$totalServices = getOne("SELECT COUNT(*) as count FROM service_lists")['count'] ?? 0;
$totalTestimonials = getOne("SELECT COUNT(*) as count FROM testimonials")['count'] ?? 0;
$totalStories = getOne("SELECT COUNT(*) as count FROM our_stories")['count'] ?? 0;
$totalQuotes = getOne("SELECT COUNT(*) as count FROM home_quotes")['count'] ?? 0;
$totalFooterQuotes = getOne("SELECT COUNT(*) as count FROM home_footer_quotes")['count'] ?? 0;
$totalContactQuotes = getOne("SELECT COUNT(*) as count FROM contact_quotes")['count'] ?? 0;

// Get recent quotes
$recentQuotes = getAll("SELECT * FROM contact_quotes ORDER BY created_at DESC LIMIT 5");

$pageTitle = 'Dashboard';
$activePage = 'dashboard';
$additionalStyles = '<style>
    .stat-card {
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card .icon {
        font-size: 40px;
        opacity: 0.3;
    }
</style>';

require_once __DIR__ . '/includes/header.php';
?>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Dashboard</h2>
                    <a href="<?php echo SITE_URL; ?>" target="_blank" class="btn btn-outline-primary">
                        <i class="fas fa-external-link-alt"></i> View Website
                    </a>
                </div>

                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-card bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0">
                                        <?php echo $totalServices; ?>
                                    </h3>
                                    <p class="mb-0">Services</p>
                                </div>
                                <i class="fas fa-ambulance icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-success text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0">
                                        <?php echo $totalTestimonials; ?>
                                    </h3>
                                    <p class="mb-0">Testimonials</p>
                                </div>
                                <i class="fas fa-star icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-info text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0">
                                        <?php echo $totalStories; ?>
                                    </h3>
                                    <p class="mb-0">Stories</p>
                                </div>
                                <i class="fas fa-book icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-warning text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0">
                                        <?php echo $totalQuotes + $totalFooterQuotes + $totalContactQuotes; ?>
                                    </h3>
                                    <p class="mb-0">Total Quotes</p>
                                </div>
                                <i class="fas fa-envelope icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Quotes -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-envelope-open-text"></i> Recent Contact Quotes</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Service</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recentQuotes)): ?>
                                        <?php foreach ($recentQuotes as $quote): ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($quote['name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($quote['email']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($quote['services']); ?>
                                                </td>
                                                <td>
                                                    <?php echo date('M d, Y', strtotime($quote['created_at'])); ?>
                                                </td>
                                                <td>
                                                    <a href="quotes.php?id=<?php echo $quote['id']; ?>"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
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

                <!-- Quick Actions -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="mb-3">Quick Actions</h5>
                    </div>
                    <div class="col-md-3">
                        <a href="services.php?action=add" class="btn btn-outline-primary w-100 mb-2">
                            <i class="fas fa-plus"></i> Add New Service
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="testimonials.php?action=add" class="btn btn-outline-success w-100 mb-2">
                            <i class="fas fa-plus"></i> Add Testimonial
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="stories.php?action=add" class="btn btn-outline-info w-100 mb-2">
                            <i class="fas fa-plus"></i> Add Story
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="quotes.php" class="btn btn-outline-warning w-100 mb-2">
                            <i class="fas fa-envelope"></i> View All Quotes
                        </a>
                    </div>
                </div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
