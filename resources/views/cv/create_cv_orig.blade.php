<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create CV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Create Your CV</h2>
    <form action="{{ route('cv.generate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="education" class="form-label">Education</label>
            <textarea class="form-control" id="education" name="education" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="experience" class="form-label">Experience</label>
            <textarea class="form-control" id="experience" name="experience" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="skills" class="form-label">Skills</label>
            <textarea class="form-control" id="skills" name="skills" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Generate CV</button>
    </form>
</div>
</body>
</html>
