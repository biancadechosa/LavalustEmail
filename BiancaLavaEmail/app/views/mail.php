<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compose Mail</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f1f3f4;
            font-family: 'Arial', sans-serif;
        }

        .email-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }

        .email-form h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #343a40;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4285f4;
        }

        .btn-custom {
            background-color: #4285f4;
            color: #fff;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #357ae8;
        }

        .attachment-label {
            display: inline-block;
            background-color: #e8f0fe;
            padding: 8px 15px;
            border-radius: 20px;
            color: #4285f4;
            cursor: pointer;
        }

        .attachment-label:hover {
            background-color: #d7e3fc;
        }

        #file-chosen {
            margin-left: 10px;
            font-size: 0.9rem;
            color: #5f6368;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .email-footer {
            text-align: right;
            margin-top: 20px;
        }

        .email-footer a {
            color: #4285f4;
            text-decoration: none;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="email-form">
        <h2>Compose Email</h2>
        <?php flash_alert();  ?>
        <form action="<?=site_url('mail');?>" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="from-email">From</label>
                <input type="email" class="form-control" id="from-email" name="from-email" placeholder="Sender's email" required>
            </div>

            <!-- To Email -->
            <div class="form-group">
                <label for="to-email">To</label>
                <input type="email" class="form-control" id="to-email" name="to-email" placeholder="Recipient's email" required>
            </div>

            <!-- Subject -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
            </div>

            <!-- Message -->
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
            </div>

            <!-- Attachment -->
            <div class="form-group">
                <label class="attachment-label" for="attachment">Attach files</label>
                <input type="file" id="attachment" name="attachment" class="d-none">
                <span id="file-chosen">No file chosen</span>
            </div>

            <!-- Send Button -->
            <div class="email-footer">
                <button type="submit" class="btn btn-custom">Send</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const fileInput = document.getElementById('attachment');
    const fileChosen = document.getElementById('file-chosen');

    fileInput.addEventListener('change', function() {
        fileChosen.textContent = this.files[0] ? this.files[0].name : 'No file chosen';
    });
</script>
</body>
</html>
