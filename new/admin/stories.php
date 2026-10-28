<?php
/**
 * Admin Stories Management
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
$storyId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
            case 'edit':
                $title = trim($_POST['title']);
                $content = trim($_POST['content']);
                $isActive = isset($_POST['is_active']) ? 1 : 0;

                // Handle image uploads
                $img1 = '';
                $img2 = '';
                $img3 = '';

                if (isset($_FILES['img1']) && $_FILES['img1']['error'] === UPLOAD_ERR_OK) {
                    $img1 = uploadFile($_FILES['img1'], 'stories');
                    if (!$img1) {
                        $error = 'Failed to upload image 1';
                    }
                } elseif ($_POST['action'] === 'edit' && !empty($_POST['existing_img1'])) {
                    $img1 = $_POST['existing_img1'];
                }

                if (isset($_FILES['img2']) && $_FILES['img2']['error'] === UPLOAD_ERR_OK) {
                    $img2 = uploadFile($_FILES['img2'], 'stories');
                    if (!$img2) {
                        $error = 'Failed to upload image 2';
                    }
                } elseif ($_POST['action'] === 'edit' && !empty($_POST['existing_img2'])) {
                    $img2 = $_POST['existing_img2'];
                }

                if (isset($_FILES['img3']) && $_FILES['img3']['error'] === UPLOAD_ERR_OK) {
                    $img3 = uploadFile($_FILES['img3'], 'stories');
                    if (!$img3) {
                        $error = 'Failed to upload image 3';
                    }
                } elseif ($_POST['action'] === 'edit' && !empty($_POST['existing_img3'])) {
                    $img3 = $_POST['existing_img3'];
                }

                if (empty($error)) {
                    if ($_POST['action'] === 'add') {
                        $query = "INSERT INTO our_stories (title, content, img1, img2, img3, is_active, created_at, updated_at)
                                  VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
                        $result = executeQuery($query, 'sssssi', [$title, $content, $img1, $img2, $img3, $isActive]);

                        if ($result) {
                            $message = 'Story added successfully!';
                            $action = 'list';
                        } else {
                            $error = 'Failed to add story';
                        }
                    } else {
                        $query = "UPDATE our_stories SET title = ?, content = ?, img1 = ?, img2 = ?, img3 = ?, is_active = ?, updated_at = NOW() WHERE id = ?";
                        $result = executeQuery($query, 'sssssii', [$title, $content, $img1, $img2, $img3, $isActive, $storyId]);

                        if ($result) {
                            $message = 'Story updated successfully!';
                            $action = 'list';
                        } else {
                            $error = 'Failed to update story';
                        }
                    }
                }
                break;

            case 'delete':
                $id = intval($_POST['id']);
                // Get story to delete images
                $story = getOne("SELECT * FROM our_stories WHERE id = ?", 'i', [$id]);

                if ($story) {
                    // Delete images
                    if (!empty($story['img1'])) deleteFile($story['img1']);
                    if (!empty($story['img2'])) deleteFile($story['img2']);
                    if (!empty($story['img3'])) deleteFile($story['img3']);

                    // Delete story
                    $query = "DELETE FROM our_stories WHERE id = ?";
                    $result = executeQuery($query, 'i', [$id]);

                    if ($result) {
                        $message = 'Story deleted successfully!';
                    } else {
                        $error = 'Failed to delete story';
                    }
                }
                break;
        }
    }
}

// Get story for editing
$story = null;
if ($action === 'edit' && $storyId > 0) {
    $story = getOne("SELECT * FROM our_stories WHERE id = ?", 'i', [$storyId]);
    if (!$story) {
        $error = 'Story not found';
        $action = 'list';
    }
}

// Get all stories
$stories = getAll("SELECT * FROM our_stories ORDER BY created_at DESC");

$pageTitle = 'Stories Management';
$activePage = 'stories';
$additionalStyles = '<style>
    .story-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        background: white;
    }

    .story-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .story-images {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2px;
        height: 200px;
    }

    .story-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .story-image-placeholder {
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
    }

    .form-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .image-preview {
        max-width: 100%;
        max-height: 200px;
        margin-top: 10px;
        border-radius: 8px;
    }

    .badge-status {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
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
            <!-- Stories List -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-book"></i> Our Stories Management</h2>
                <a href="?action=add" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Story
                </a>
            </div>

            <div class="container-fluid">
                <div class="row g-4">
                    <?php foreach ($stories as $st): ?>
                        <div class="col-lg-6 col-md-12">
                        <div class="story-card">
                            <div class="position-relative">
                                <div class="story-images">
                                    <?php if (!empty($st['img1'])): ?>
                                        <?php
                                        $img1Path = $st['img1'];
                                        if (strpos($img1Path, '/') === 0 && strpos($img1Path, 'http') !== 0) {
                                            $img1Path = SITE_URL . $img1Path;
                                        }
                                        ?>
                                        <img src="<?php echo htmlspecialchars($img1Path); ?>"
                                             class="story-image" alt="Image 1">
                                    <?php else: ?>
                                        <div class="story-image-placeholder">
                                            <i class="fas fa-image fa-2x"></i>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($st['img2'])): ?>
                                        <?php
                                        $img2Path = $st['img2'];
                                        if (strpos($img2Path, '/') === 0 && strpos($img2Path, 'http') !== 0) {
                                            $img2Path = SITE_URL . $img2Path;
                                        }
                                        ?>
                                        <img src="<?php echo htmlspecialchars($img2Path); ?>"
                                             class="story-image" alt="Image 2">
                                    <?php else: ?>
                                        <div class="story-image-placeholder">
                                            <i class="fas fa-image fa-2x"></i>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($st['img3'])): ?>
                                        <?php
                                        $img3Path = $st['img3'];
                                        if (strpos($img3Path, '/') === 0 && strpos($img3Path, 'http') !== 0) {
                                            $img3Path = SITE_URL . $img3Path;
                                        }
                                        ?>
                                        <img src="<?php echo htmlspecialchars($img3Path); ?>"
                                             class="story-image" alt="Image 3">
                                    <?php else: ?>
                                        <div class="story-image-placeholder">
                                            <i class="fas fa-image fa-2x"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <span class="badge <?php echo $st['is_active'] ? 'bg-success' : 'bg-secondary'; ?> badge-status">
                                    <?php echo $st['is_active'] ? 'Active' : 'Inactive'; ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($st['title']); ?></h5>
                                <p class="card-text text-muted">
                                    <?php echo truncateText(strip_tags($st['content']), 150); ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i>
                                        <?php echo formatDate($st['created_at'], 'd M Y'); ?>
                                    </small>
                                    <div>
                                        <a href="?action=edit&id=<?php echo $st['id']; ?>"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="deleteStory(<?php echo $st['id']; ?>, '<?php echo htmlspecialchars($st['title']); ?>')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if (empty($stories)): ?>
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-book fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">No stories yet</h4>
                                <p class="text-muted">Start by adding your first story</p>
                                <a href="?action=add" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Story
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ($action === 'add' || $action === 'edit'): ?>
            <!-- Add/Edit Form -->
            <div class="mb-4">
                <a href="stories.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Stories
                </a>
            </div>

            <div class="form-section">
                <h3 class="mb-4">
                    <i class="fas fa-<?php echo $action === 'add' ? 'plus' : 'edit'; ?>"></i>
                    <?php echo $action === 'add' ? 'Add New Story' : 'Edit Story'; ?>
                </h3>

                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <?php if ($story): ?>
                        <input type="hidden" name="existing_img1" value="<?php echo htmlspecialchars($story['img1']); ?>">
                        <input type="hidden" name="existing_img2" value="<?php echo htmlspecialchars($story['img2']); ?>">
                        <input type="hidden" name="existing_img3" value="<?php echo htmlspecialchars($story['img3']); ?>">
                    <?php endif; ?>

                    <div class="mb-4">
                        <label for="title" class="form-label">Story Title *</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="<?php echo $story ? htmlspecialchars($story['title']) : ''; ?>"
                               required placeholder="Enter story title">
                    </div>

                    <div class="mb-4">
                        <label for="content" class="form-label">Story Content *</label>
                        <textarea class="form-control" id="content" name="content" rows="8" required
                                  placeholder="Enter the full story content..."><?php echo $story ? htmlspecialchars($story['content']) : ''; ?></textarea>
                        <small class="text-muted">You can use HTML tags for formatting</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   <?php echo (!$story || $story['is_active']) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="is_active">
                                Active (visible on website)
                            </label>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Story Images</h5>
                    <p class="text-muted mb-4">Upload 3 images for this story. All images are required for new stories.</p>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="img1" class="form-label">Image 1 *</label>
                            <input type="file" class="form-control" id="img1" name="img1"
                                   accept="image/*" <?php echo !$story ? 'required' : ''; ?>
                                   onchange="previewImage(this, 'img1-preview')">
                            <?php if ($story && !empty($story['img1'])): ?>
                                <img src="<?php echo htmlspecialchars($story['img1']); ?>"
                                     id="img1-preview" class="image-preview" alt="Image 1">
                            <?php else: ?>
                                <img id="img1-preview" class="image-preview" style="display: none;">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="img2" class="form-label">Image 2 *</label>
                            <input type="file" class="form-control" id="img2" name="img2"
                                   accept="image/*" <?php echo !$story ? 'required' : ''; ?>
                                   onchange="previewImage(this, 'img2-preview')">
                            <?php if ($story && !empty($story['img2'])): ?>
                                <img src="<?php echo htmlspecialchars($story['img2']); ?>"
                                     id="img2-preview" class="image-preview" alt="Image 2">
                            <?php else: ?>
                                <img id="img2-preview" class="image-preview" style="display: none;">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="img3" class="form-label">Image 3 *</label>
                            <input type="file" class="form-control" id="img3" name="img3"
                                   accept="image/*" <?php echo !$story ? 'required' : ''; ?>
                                   onchange="previewImage(this, 'img3-preview')">
                            <?php if ($story && !empty($story['img3'])): ?>
                                <img src="<?php echo htmlspecialchars($story['img3']); ?>"
                                     id="img3-preview" class="image-preview" alt="Image 3">
                            <?php else: ?>
                                <img id="img3-preview" class="image-preview" style="display: none;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> <?php echo $action === 'add' ? 'Add Story' : 'Update Story'; ?>
                        </button>
                        <a href="stories.php" class="btn btn-secondary btn-lg">Cancel</a>
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
    function deleteStory(id, title) {
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
</script>';
require_once __DIR__ . '/includes/footer.php';
?>
