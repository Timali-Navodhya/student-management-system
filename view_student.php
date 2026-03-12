<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-5 bg-dark d-flex align-items-center">
                <div id="studentCarousel" class="carousel slide w-100" data-bs-ride="carousel">
                    <div class="carousel-inner" id="carouselImages">
                        </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#studentCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#studentCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            
            <div class="col-md-7">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 id="s_name" class="fw-bold text-primary mb-0">Loading...</h2>
                        <span class="badge bg-success fs-6">Active Student</span>
                    </div>
                    
                    <hr class="mb-4">
                    
                    <h5 class="fw-bold text-secondary">Contact Information</h5>
                    <p class="fs-5 mb-2">📧 <strong>Email:</strong> <span id="s_email" class="text-dark">...</span></p>
                    <p class="fs-5 mb-4">📞 <strong>Phone:</strong> <span id="s_phone" class="text-dark">...</span></p>
                    
                    <h5 class="fw-bold text-secondary">Home Address</h5>
                    <p id="s_address" class="fs-5 text-dark bg-light p-3 rounded border">...</p>

                    <div class="mt-5 d-flex gap-2">
                        <a href="index.html" class="btn btn-outline-secondary btn-lg">&larr; Back to Dashboard</a>
                        <a id="editBtn" href="#" class="btn btn-warning btn-lg fw-bold">Edit Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const studentId = urlParams.get('id');

    fetch(`get_student.php?id=${studentId}`)
        .then(response => response.json())
        .then(data => {
            if(data.id) {
                document.getElementById('s_name').innerText = data.full_name;
                document.getElementById('s_email').innerText = data.email;
                document.getElementById('s_phone').innerText = data.phone || 'N/A';
                document.getElementById('s_address').innerText = data.address || 'N/A';
                document.getElementById('editBtn').href = `edit_student.html?id=${data.id}`;

                
                const carouselInner = document.getElementById('carouselImages');
                if(data.images && data.images.length > 0) {
                    data.images.forEach((img, index) => {
                        let activeClass = index === 0 ? 'active' : '';
                        carouselInner.innerHTML += `
                            <div class="carousel-item ${activeClass}">
                                <img src="${img}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Student Photo">
                            </div>
                        `;
                    });
                } else {
                    
                    carouselInner.innerHTML = `
                        <div class="carousel-item active">
                            <img src="https://via.placeholder.com/400x400?text=No+Photo+Available" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="No Photo">
                        </div>
                    `;
                }
            }
        })
        .catch(error => console.error('Error fetching data:', error));
</script>
</body>
</html>