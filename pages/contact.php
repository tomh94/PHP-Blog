<?php
global $posts;

require_once '../components/header.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $messageText = htmlspecialchars(trim($_POST['message'] ?? ''));


    if (empty($name) || empty($email) || empty($subject) || empty($messageText)) {
        $message = 'Všechna pole jsou povinná!';
        $messageType = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Neplatná emailová adresa!';
        $messageType = 'danger';
    } else {
        $message = 'Děkujeme za vaši zprávu! Brzy se vám ozveme.';
        $messageType = 'success';

        if ($messageType === 'success') {
            $name = $email = $subject = $messageText = '';
            ?>
            <div class="card border-success">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0">Odeslaná data:</h3>
            </div>
            <div class="card-body">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <th width="150">Jméno:</th>
                    <td><?= $_POST['name'] ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?= $_POST['email'] ?></td>
                </tr>
                <tr>
                    <th>Předmět:</th>
                    <td><?= $_POST['subject'] ?></td>
                </tr>
                <tr>
                    <th>Zpráva:</th>
                    <td><?= nl2br($_POST['message']) ?></td>
                </tr>
                </tbody>
            </table>
            <?php
        }
    }
}
?>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="mb-4">Kontaktujte nás</h1>

                <?php if ($message): ?>
                    <div class="alert alert-<?= $messageType ?> alert-dismissible fade show" role="alert">
                        <?= $message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card shadow">
                    <div class="card-body p-4">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Jméno *</label>
                                <input type="text"
                                       class="form-control"
                                       id="name"
                                       name="name"
                                       value="<?= $name ?? '' ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email"
                                       class="form-control"
                                       id="email"
                                       name="email"
                                       value="<?= $email ?? '' ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Předmět *</label>
                                <input type="text"
                                       class="form-control"
                                       id="subject"
                                       name="subject"
                                       value="<?= $subject ?? '' ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Zpráva *</label>
                                <textarea class="form-control"
                                          id="message"
                                          name="message"
                                          rows="6"
                                          required><?= $messageText ?? '' ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Odeslat zprávu
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-envelope fs-1 text-primary"></i>
                                <h5 class="card-title mt-3">Email</h5>
                                <p class="card-text">info@mujblog.cz</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-telephone fs-1 text-primary"></i>
                                <h5 class="card-title mt-3">Telefon</h5>
                                <p class="card-text">+420 123 456 789</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-geo-alt fs-1 text-primary"></i>
                                <h5 class="card-title mt-3">Adresa</h5>
                                <p class="card-text">Praha 1, Česká republika</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once '../components/footer.php'; ?>