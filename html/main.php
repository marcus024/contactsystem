<?php 
session_start();

include "auth/database/db.php";

if (!isset($_SESSION['emailAddress'])) {
    echo "<script>alert('User not logged in.'); window.location.href='login.php';</script>";
    exit();
}

// Get the user's email from the session
$emailFK = mysqli_real_escape_string($conn, $_SESSION['emailAddress']);

// Pagination variables
$contactsPerPage = 5; // Change this to the number of contacts you want per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $contactsPerPage;

// Fetch the total number of contacts for the current user
$totalContactsQuery = "SELECT COUNT(*) AS total FROM contactInfo WHERE emailFK = '$emailFK'";
$totalContactsResult = mysqli_query($conn, $totalContactsQuery);
$totalContacts = mysqli_fetch_assoc($totalContactsResult)['total'];
$totalPages = ceil($totalContacts / $contactsPerPage);

// Fetch the contacts for the current user with pagination
$sql = "SELECT * FROM contactInfo WHERE emailFK = '$emailFK' LIMIT $offset, $contactsPerPage";
$result = mysqli_query($conn, $sql);
?>

<?php include ('header-footer/headermain.php'); ?>

<div class="content-wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-12">
              <div class="card-body">
                <h2 class="card-title text-primary text-center">CONTACT SYSTEM</h2>
                
                <!-- Contact Table Begins Here -->
                <div class="mt-3">
                    <div class="d-flex justify-content-between">
                        <h3>Contacts</h3>
                        <div>
                            <a href="add_contacts.php" class="me-2">Add Contact</a>
                            <a href="main.php" class="me-2">Contacts</a>
                            <a href="logout_front.php">Logout</a>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-secondary" id="searchBtn" type="button">Search</button>
                        </div>
                    </div>
                    
                    <table class="table table-bordered" id="contactsTable">
                      <thead class="table-light">
                          <tr>
                              <th>Name</th>
                              <th>Company</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<tr>
                                      <td>{$row['contactName']}</td>
                                      <td>{$row['contactCompany']}</td>
                                      <td>{$row['contactPhone']}</td>
                                      <td>{$row['contactEmail']}</td>
                                      <td>
                                          <a href='edit_contact.php?id={$row['contact_id']}'>Edit</a> | 
                                          <a href='#' class='text-danger' data-bs-toggle='modal' data-bs-target='#deleteContactModal' data-id='{$row['contact_id']}'>Delete</a>
                                      </td>
                                  </tr>";
                              }
                          } else {
                              echo "<tr><td colspan='5' class='text-center'>No contacts found.</td></tr>";
                          }
                          ?>
                      </tbody>
                  </table>
                    <div class="mb-3"></div>
                    <!-- Pagination Controls -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item"><a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Previous</a></li>
                            <?php endif; ?>
                            
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php if ($i === $currentPage) echo 'active'; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item"><a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                <!-- Contact Table Ends Here -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal for delete contact -->
<div class="modal fade" id="deleteContactModal" tabindex="-1" aria-labelledby="deleteContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteContactModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this contact?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteContactForm" method="POST" action="delete_contact.php">
                    <input type="hidden" name="contact_id" id="contactIdToDelete">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#searchBtn").click(function() {
        var query = $("#search").val();
        $.ajax({
            url: "search_contacts.php",
            method: "POST",
            data: {search: query},
            success: function(data) {
                $("#contactsTable tbody").html(data);
            }
        });
    });

    $("#search").on("keypress", function(e) {
        if (e.which === 13) {
            $("#searchBtn").click();
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteLinks = document.querySelectorAll('[data-bs-target="#deleteContactModal"]');

    deleteLinks.forEach(link => {
        link.addEventListener('click', function() {
            const contactId = this.getAttribute('data-id');
            document.getElementById('contactIdToDelete').value = contactId;
        });
    });
});
</script>


<?php include ('header-footer/footermain.php'); ?>
