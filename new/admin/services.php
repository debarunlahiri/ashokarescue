<?php
/**
 * Admin Services Management
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
$serviceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
            case 'edit':
                $title = trim($_POST['title']);
                $slug = !empty($_POST['slug']) ? generateSlug($_POST['slug']) : generateSlug($title);
                $content = trim($_POST['content']);
                $priority = intval($_POST['priority']);
                $isActive = isset($_POST['is_active']) ? 1 : 0;

                // Handle banner upload
                $banner = '';
                if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
                    $banner = uploadFile($_FILES['banner'], 'services');
                    if (!$banner) {
                        $error = 'Failed to upload banner image';
                    }
                } elseif ($_POST['action'] === 'edit' && !empty($_POST['existing_banner'])) {
                    $banner = $_POST['existing_banner'];
                }

                // Handle additional images
                $img2 = '';
                $img3 = '';
                $img4 = '';
                $img5 = '';

                if (isset($_FILES['img2']) && $_FILES['img2']['error'] === UPLOAD_ERR_OK) {
                    $img2 = uploadFile($_FILES['img2'], 'services');
                } elseif ($_POST['action'] === 'edit' && !empty($_POST['existing_img2'])) {
                    $img2 = $_POST['existing_img2'];
                }

                if (isset($_FILES['img3']) && $_FILES['img3']['error'] === UPLOAD_ERR_OK) {
                    $img3 = uploadFile($_FILES['img3'], 'services');
                } elseif ($_POST['action'] === 'edit' && !empty($_POST['existing_img3'])) {
                    $img3 = $_POST['existing_img3'];
                }

                if (isset($_FILES['img4']) && $_FILES['img4']['error'] === UPLOAD_ERR_OK) {
                    $img4 = uploadFile($_FILES['img4'], 'services');
                } elseif ($_POST['action'] === 'edit' && !empty($_POST['existing_img4'])) {
                    $img4 = $_POST['existing_img4'];
                }

                if (isset($_FILES['img5']) && $_FILES['img5']['error'] === UPLOAD_ERR_OK) {
                    $img5 = uploadFile($_FILES['img5'], 'services');
                } elseif ($_POST['action'] === 'edit' && !empty($_POST['existing_img5'])) {
                    $img5 = $_POST['existing_img5'];
                }

                if (empty($error)) {
                    if ($_POST['action'] === 'add') {
                        $query = "INSERT INTO service_lists (title, slug, banner, content, img2, img3, img4, img5, priority, is_active, created_at, updated_at)
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
                        $result = executeQuery($query, 'ssssssssii', [$title, $slug, $banner, $content, $img2, $img3, $img4, $img5, $priority, $isActive]);

                        if ($result) {
                            $message = 'Service added successfully!';
                            $action = 'list';
                        } else {
                            $error = 'Failed to add service';
                        }
                    } else {
                        $query = "UPDATE service_lists SET title = ?, slug = ?, banner = ?, content = ?, img2 = ?, img3 = ?, img4 = ?, img5 = ?, priority = ?, is_active = ?, updated_at = NOW() WHERE id = ?";
                        $result = executeQuery($query, 'sssssssssii', [$title, $slug, $banner, $content, $img2, $img3, $img4, $img5, $priority, $isActive, $serviceId]);

                        if ($result) {
                            $message = 'Service updated successfully!';
                            $action = 'list';
                        } else {
                            $error = 'Failed to update service';
                        }
                    }
                }
                break;

            case 'delete':
                $id = intval($_POST['id']);
                // Get service to delete images
                $service = getOne("SELECT * FROM service_lists WHERE id = ?", 'i', [$id]);

                if ($service) {
                    // Delete images
                    if (!empty($service['banner'])) deleteFile($service['banner']);
                    if (!empty($service['img2'])) deleteFile($service['img2']);
                    if (!empty($service['img3'])) deleteFile($service['img3']);
                    if (!empty($service['img4'])) deleteFile($service['img4']);
                    if (!empty($service['img5'])) deleteFile($service['img5']);

                    // Delete service
                    $query = "DELETE FROM service_lists WHERE id = ?";
                    $result = executeQuery($query, 'i', [$id]);

                    if ($result) {
                        $message = 'Service deleted successfully!';
                    } else {
                        $error = 'Failed to delete service';
                    }
                }
                break;
        }
    }
}

// Get service for editing
$service = null;
if ($action === 'edit' && $serviceId > 0) {
    $service = getOne("SELECT * FROM service_lists WHERE id = ?", 'i', [$serviceId]);
    if (!$service) {
        $error = 'Service not found';
        $action = 'list';
    }
}

// Get all services
$services = getAll("SELECT * FROM service_lists ORDER BY priority ASC, created_at DESC");

$pageTitle = 'Services Management';
$activePage = 'services';
$additionalStyles = '<style>
    .service-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .service-card .card-body {
        display: flex;
        flex-direction: column;
        min-height: 180px;
    }

    .service-card .card-text {
        margin-bottom: 1rem;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .service-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .badge-status {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .form-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .image-preview {
        max-width: 200px;
        max-height: 200px;
        margin-top: 10px;
        border-radius: 8px;
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
            <!-- Services List -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-ambulance"></i> Services Management</h2>
                <a href="?action=add" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Service
                </a>
            </div>

            <div class="container-fluid">
                <div class="row g-4">
                    <?php foreach ($services as $svc): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card service-card">
                            <div class="position-relative">
                                <?php if (!empty($svc['banner'])): ?>
                                    <?php
                                    $imagePath = $svc['banner'];
                                    if (strpos($imagePath, '/') === 0 && strpos($imagePath, 'http') !== 0) {
                                        $imagePath = '..' . $imagePath;
                                    }
                                    ?>
                                    <img src="<?php echo htmlspecialchars($imagePath); ?>"
                                         class="service-image"
                                         alt="<?php echo htmlspecialchars($svc['title']); ?>">
                                <?php else: ?>
                                    <div class="service-image bg-secondary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image fa-3x text-white-50"></i>
                                    </div>
                                <?php endif; ?>
                                <span class="badge <?php echo $svc['is_active'] ? 'bg-success' : 'bg-secondary'; ?> badge-status">
                                    <?php echo $svc['is_active'] ? 'Active' : 'Inactive'; ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($svc['title']); ?></h5>
                                <p class="card-text text-muted small">
                                    <?php echo truncateText($svc['content'], 100); ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-info">Priority: <?php echo $svc['priority']; ?></span>
                                    <div>
                                        <a href="?action=edit&id=<?php echo $svc['id']; ?>"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="deleteService(<?php echo $svc['id']; ?>, '<?php echo htmlspecialchars($svc['title']); ?>')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php elseif ($action === 'add' || $action === 'edit'): ?>
            <!-- Add/Edit Form -->
            <div class="mb-4">
                <a href="services.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Services
                </a>
            </div>

            <div class="form-section">
                <h3 class="mb-4">
                    <i class="fas fa-<?php echo $action === 'add' ? 'plus' : 'edit'; ?>"></i>
                    <?php echo $action === 'add' ? 'Add New Service' : 'Edit Service'; ?>
                </h3>

                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <?php if ($service): ?>
                        <input type="hidden" name="existing_banner" value="<?php echo htmlspecialchars($service['banner']); ?>">
                        <input type="hidden" name="existing_img2" value="<?php echo htmlspecialchars($service['img2']); ?>">
                        <input type="hidden" name="existing_img3" value="<?php echo htmlspecialchars($service['img3']); ?>">
                        <input type="hidden" name="existing_img4" value="<?php echo htmlspecialchars($service['img4']); ?>">
                        <input type="hidden" name="existing_img5" value="<?php echo htmlspecialchars($service['img5']); ?>">
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">Service Title *</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="<?php echo $service ? htmlspecialchars($service['title']) : ''; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug (URL-friendly name)</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       value="<?php echo $service ? htmlspecialchars($service['slug']) : ''; ?>"
                                       placeholder="Leave empty to auto-generate">
                                <small class="text-muted">Example: charter-air-ambulance</small>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Description *</label>
                                <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $service ? htmlspecialchars($service['content']) : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <input type="number" class="form-control" id="priority" name="priority"
                                       value="<?php echo $service ? $service['priority'] : 0; ?>" min="0">
                                <small class="text-muted">Lower numbers appear first</small>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           <?php echo (!$service || $service['is_active']) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Images</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="banner" class="form-label">Banner Image *</label>
                            <input type="file" class="form-control" id="banner" name="banner"
                                   accept="image/*" <?php echo !$service ? 'required' : ''; ?>
                                   onchange="previewImage(this, 'banner-preview')">
                            <?php if ($service && !empty($service['banner'])): ?>
                                <?php
                                $bannerPath = $service['banner'];
                                if (strpos($bannerPath, '/') === 0 && strpos($bannerPath, 'http') !== 0) {
                                    $bannerPath = '..' . $bannerPath;
                                }
                                ?>
                                <img src="<?php echo htmlspecialchars($bannerPath); ?>"
                                     id="banner-preview" class="image-preview" alt="Banner">
                            <?php else: ?>
                                <img id="banner-preview" class="image-preview" style="display: none;">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="img2" class="form-label">Additional Image 2</label>
                            <input type="file" class="form-control" id="img2" name="img2"
                                   accept="image/*" onchange="previewImage(this, 'img2-preview')">
                            <?php if ($service && !empty($service['img2'])): ?>
                                <?php
                                $img2Path = $service['img2'];
                                if (strpos($img2Path, '/') === 0 && strpos($img2Path, 'http') !== 0) {
                                    $img2Path = '..' . $img2Path;
                                }
                                ?>
                                <img src="<?php echo htmlspecialchars($img2Path); ?>"
                                     id="img2-preview" class="image-preview" alt="Image 2">
                            <?php else: ?>
                                <img id="img2-preview" class="image-preview" style="display: none;">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="img3" class="form-label">Additional Image 3</label>
                            <input type="file" class="form-control" id="img3" name="img3"
                                   accept="image/*" onchange="previewImage(this, 'img3-preview')">
                            <?php if ($service && !empty($service['img3'])): ?>
                                <?php
                                $img3Path = $service['img3'];
                                if (strpos($img3Path, '/') === 0 && strpos($img3Path, 'http') !== 0) {
                                    $img3Path = '..' . $img3Path;
                                }
                                ?>
                                <img src="<?php echo htmlspecialchars($img3Path); ?>"
                                     id="img3-preview" class="image-preview" alt="Image 3">
                            <?php else: ?>
                                <img id="img3-preview" class="image-preview" style="display: none;">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="img4" class="form-label">Additional Image 4</label>
                            <input type="file" class="form-control" id="img4" name="img4"
                                   accept="image/*" onchange="previewImage(this, 'img4-preview')">
                            <?php if ($service && !empty($service['img4'])): ?>
                                <?php
                                $img4Path = $service['img4'];
                                if (strpos($img4Path, '/') === 0 && strpos($img4Path, 'http') !== 0) {
                                    $img4Path = '..' . $img4Path;
                                }
                                ?>
                                <img src="<?php echo htmlspecialchars($img4Path); ?>"
                                     id="img4-preview" class="image-preview" alt="Image 4">
                            <?php else: ?>
                                <img id="img4-preview" class="image-preview" style="display: none;">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="img5" class="form-label">Additional Image 5</label>
                            <input type="file" class="form-control" id="img5" name="img5"
                                   accept="image/*" onchange="previewImage(this, 'img5-preview')">
                            <?php if ($service && !empty($service['img5'])): ?>
                                <?php
                                $img5Path = $service['img5'];
                                if (strpos($img5Path, '/') === 0 && strpos($img5Path, 'http') !== 0) {
                                    $img5Path = '..' . $img5Path;
                                }
                                ?>
                                <img src="<?php echo htmlspecialchars($img5Path); ?>"
                                     id="img5-preview" class="image-preview" alt="Image 5">
                            <?php else: ?>
                                <img id="img5-preview" class="image-preview" style="display: none;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> <?php echo $action === 'add' ? 'Add Service' : 'Update Service'; ?>
                        </button>
                        <a href="services.php" class="btn btn-secondary btn-lg">Cancel</a>
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
    function deleteService(id, title) {
        if (confirm(\'Are you sure you want to delete "\' + title + \'"? This action cannot be undone.\')) {
            document.getElementById(\'deleteId\').value = id;
            document.getElementById(\'deleteForm\').submit();
        }
    }

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = \'block\';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById(\'title\').addEventListener(\'input\', function() {
        const slugInput = document.getElementById(\'slug\');
        if (!slugInput.value || slugInput.dataset.autoGenerated) {
            const slug = this.value.toLowerCase()
                .replace(/[^a-z0-9]+/g, \'-\')
                .replace(/^-+|-+$/g, \'\');
            slugInput.value = slug;
            slugInput.dataset.autoGenerated = \'true\';
        }
    });

    document.getElementById(\'slug\').addEventListener(\'input\', function() {
        if (this.value) {
            delete this.dataset.autoGenerated;
        }
    });
</script>';
require_once __DIR__ . '/includes/footer.php';
?>
