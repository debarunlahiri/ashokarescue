<?php
/**
 * Admin Testimonials Management
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

$message = '';
$error = '';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$testimonialId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
            case 'edit':
                $content = trim($_POST['content']);
                $rating = intval($_POST['rating']);
                $author = trim($_POST['author']);
                $designation = trim($_POST['designtion']); // Note: typo in database field name
                $isActive = isset($_POST['is_active']) ? 1 : 0;

                if (empty($content) || empty($author)) {
                    $error = 'Content and author name are required';
                } else {
                    if ($_POST['action'] === 'add') {
                        $query = "INSERT INTO testimonials (content, rating, author, designtion, is_active, created_at, updated_at)
                                  VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
                        $result = executeQuery($query, 'sissi', [$content, $rating, $author, $designation, $isActive]);

                        if ($result) {
                            $message = 'Testimonial added successfully!';
                            $action = 'list';
                        } else {
                            $error = 'Failed to add testimonial';
                        }
                    } else {
                        $query = "UPDATE testimonials SET content = ?, rating = ?, author = ?, designtion = ?, is_active = ?, updated_at = NOW() WHERE id = ?";
                        $result = executeQuery($query, 'sissii', [$content, $rating, $author, $designation, $isActive, $testimonialId]);

                        if ($result) {
                            $message = 'Testimonial updated successfully!';
                            $action = 'list';
                        } else {
                            $error = 'Failed to update testimonial';
                        }
                    }
                }
                break;

            case 'delete':
                $id = intval($_POST['id']);
                $query = "DELETE FROM testimonials WHERE id = ?";
                $result = executeQuery($query, 'i', [$id]);

                if ($result) {
                    $message = 'Testimonial deleted successfully!';
                } else {
                    $error = 'Failed to delete testimonial';
                }
                break;
        }
    }
}

// Get testimonial for editing
$testimonial = null;
if ($action === 'edit' && $testimonialId > 0) {
    $testimonial = getOne("SELECT * FROM testimonials WHERE id = ?", 'i', [$testimonialId]);
    if (!$testimonial) {
        $error = 'Testimonial not found';
        $action = 'list';
    }
}

// Get all testimonials
$testimonials = getAll("SELECT * FROM testimonials ORDER BY created_at DESC");

$pageTitle = 'Testimonials Management';
$activePage = 'testimonials';
$additionalStyles = '<style>
    .testimonial-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: none;
        border-radius: 12px;
        background: white;
        padding: 25px;
        margin-bottom: 20px;
        position: relative;
    }

    .testimonial-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .rating-stars {
        color: #ffc107;
    }

    .quote-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 40px;
        color: rgba(102, 126, 234, 0.1);
    }

    .form-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .star-rating {
        display: inline-flex;
        gap: 5px;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        cursor: pointer;
        font-size: 30px;
        color: #ddd;
        transition: color 0.2s;
    }

    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>';

require_once __DIR__ . '/includes/header.php';
?>
        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($action === 'list'): ?>
            <!-- Testimonials List -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-star"></i> Testimonials Management</h2>
                <a href="?action=add" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Testimonial
                </a>
            </div>

            <div class="container-fluid">
                <div class="row g-4">
                    <?php foreach ($testimonials as $test): ?>
                        <div class="col-lg-6 col-md-12">
                        <div class="testimonial-card">
                            <i class="fas fa-quote-right quote-icon"></i>

                            <div class="rating-stars mb-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star<?php echo $i <= $test['rating'] ? '' : '-o'; ?>"></i>
                                <?php endfor; ?>
                            </div>

                            <p class="mb-3"><?php echo nl2br(htmlspecialchars($test['content'])); ?></p>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?php echo htmlspecialchars($test['author']); ?></strong>
                                    <?php if (!empty($test['designtion'])): ?>
                                        <br><small class="text-muted"><?php echo htmlspecialchars($test['designtion']); ?></small>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <span class="badge <?php echo $test['is_active'] ? 'bg-success' : 'bg-secondary'; ?> me-2">
                                        <?php echo $test['is_active'] ? 'Active' : 'Inactive'; ?>
                                    </span>
                                    <a href="?action=edit&id=<?php echo $test['id']; ?>"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="deleteTestimonial(<?php echo $test['id']; ?>, '<?php echo htmlspecialchars($test['author']); ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if (empty($testimonials)): ?>
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-star fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">No testimonials yet</h4>
                                <p class="text-muted">Start by adding your first testimonial</p>
                                <a href="?action=add" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Testimonial
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ($action === 'add' || $action === 'edit'): ?>
            <!-- Add/Edit Form -->
            <div class="mb-4">
                <a href="testimonials.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Testimonials
                </a>
            </div>

            <div class="form-section">
                <h3 class="mb-4">
                    <i class="fas fa-<?php echo $action === 'add' ? 'plus' : 'edit'; ?>"></i>
                    <?php echo $action === 'add' ? 'Add New Testimonial' : 'Edit Testimonial'; ?>
                </h3>

                <form method="POST">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">

                    <div class="mb-4">
                        <label for="content" class="form-label">Testimonial Content *</label>
                        <textarea class="form-control" id="content" name="content" rows="6" required
                                  placeholder="Enter the testimonial content..."><?php echo $testimonial ? htmlspecialchars($testimonial['content']) : ''; ?></textarea>
                        <small class="text-muted">The customer's feedback or review</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="author" class="form-label">Author Name *</label>
                            <input type="text" class="form-control" id="author" name="author"
                                   value="<?php echo $testimonial ? htmlspecialchars($testimonial['author']) : ''; ?>"
                                   required placeholder="John Doe">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="designtion" class="form-label">Designation / Role</label>
                            <input type="text" class="form-control" id="designtion" name="designtion"
                                   value="<?php echo $testimonial ? htmlspecialchars($testimonial['designtion']) : ''; ?>"
                                   placeholder="Patient, Doctor, etc.">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Rating *</label>
                            <div class="star-rating">
                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                    <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>"
                                           <?php echo ($testimonial && $testimonial['rating'] == $i) || (!$testimonial && $i == 5) ? 'checked' : ''; ?>>
                                    <label for="star<?php echo $i; ?>"><i class="fas fa-star"></i></label>
                                <?php endfor; ?>
                            </div>
                            <small class="text-muted d-block mt-2">Click on a star to set the rating</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                       <?php echo (!$testimonial || $testimonial['is_active']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="is_active">
                                    Active (visible on website)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> <?php echo $action === 'add' ? 'Add Testimonial' : 'Update Testimonial'; ?>
                        </button>
                        <a href="testimonials.php" class="btn btn-secondary btn-lg">Cancel</a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="deleteForm" method="POST" style="display: none;">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" id="deleteId">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
$additionalScripts = '<script>
    function deleteTestimonial(id, author) {
        if (confirm(\'Are you sure you want to delete the testimonial by "\' + author + \'"? This action cannot be undone.\')) {
            document.getElementById(\'deleteId\').value = id;
            document.getElementById(\'deleteForm\').submit();
        }
    }

    document.querySelectorAll(\'.star-rating label\').forEach(label => {
        label.addEventListener(\'mouseover\', function() {
            this.style.color = \'#ffc107\';
            let nextLabel = this.nextElementSibling;
            while (nextLabel && nextLabel.tagName === \'LABEL\') {
                nextLabel.style.color = \'#ffc107\';
                nextLabel = nextLabel.nextElementSibling;
            }
        });

        label.addEventListener(\'mouseout\', function() {
            document.querySelectorAll(\'.star-rating label\').forEach(l => {
                const radio = document.getElementById(l.getAttribute(\'for\'));
                l.style.color = radio.checked ? \'#ffc107\' : \'#ddd\';
            });
        });
    });
</script>';
require_once __DIR__ . '/includes/footer.php';
?>
