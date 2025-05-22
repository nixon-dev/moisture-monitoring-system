<style>
  #goToTopBtn {
    display: none;
    /* Hide the button by default */
  }


  .fixed-action-btn a.btn-floating {
    width: 40px;
    height: 40px;
    line-height: 40px;
    padding: 0;
    border-radius: 50%;
    transition: background-color 0.3s;
  }

  .fixed-action-btn a i {
    line-height: inherit;
  }
</style>
<?php date_default_timezone_set('Asia/Manila'); ?>
<?php if (isset($_GET['message'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      M.toast({ html: '<?php echo $_GET['message']; ?>' });
    });
  </script>
<?php endif; ?>


<html>
<!-- Navigation Bar Fixed -->
<ul id="slide-out" class="sidenav sidenav-fixed">
  <li>
    <div class="user-view">
      <div class="background">
        <img src="../images/bg1.jpg">
      </div>
      <!-- START Profile PHP Code -->
      <?php if (empty($profile)): ?>
        <a href="index.php"><img class="circle" src="../images/default_profile.png ?>"></a>
      <?php else: ?>
        <a href="index.php"><img class="circle" src="../images/profile/<?php echo $profile; ?>"></a>
      <?php endif; ?>
      <!-- END Profile PHP Code -->
      <a href="#name"><span class="white-text name">
          <?php echo $name; ?>
        </span></a>
      <?php if (empty($email)): ?>
        <a href="#email"><span class="white-text email">No Email</span></a>
      <?php else: ?>
        <a href="#email"><span class="white-text email">
            <?php echo $email; ?>
          </span></a>
      <?php endif; ?>
    </div>
  </li>
  <li><a href="https://docs.google.com/document/u/0/" target="_blank"><i class="material-icons">drafts</i>Report</a>
  </li>
  <li>
    <div class="divider"></div>
  </li>
  <li class="no-padding">
  <li><a class="subheader">Monitoring</a></li>
  <ul id="beds" class="collapsible collapsible-accordion">

  </ul>

  </li>

  <li>
    <div class="divider"></div>
  </li>
  <li <?php if (basename($_SERVER['PHP_SELF']) == 'settings.php') {
    echo ' class="active"';
  } ?>><a href="settings.php"><i
        class="material-icons">settings</i>Settings</a></li>
  <li><a href="../includes/logout.php"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>


<?php
include('../includes/db_conn.php');
$schedquery = "SELECT * FROM bedschedules ORDER BY startdate ASC";
$schedresult = mysqli_query($link, $schedquery);

$today = date("Y-m-d");
$harvestingBeds = array(); // Initialize an array to store beds with harvesting days
$endingSchedules = array();

if ($schedresult && mysqli_num_rows($schedresult) > 0) {
  while ($row = mysqli_fetch_assoc($schedresult)) {
    $startD = date('Y-m-d', strtotime($row['startdate']));
    $endD = date('Y-m-d', strtotime($row['enddate']));
    $harvestD = $row['harvest'];
    $bedname = $row['bedname'];
    $schedName = $row['name'];

    if ($today >= $startD && $today <= $endD && $harvestD == 'Yes') {
      $harvestingBeds[] = "<li><p style='margin-left: 20px;'>Bed $bedname: Harvesting Day</p></li>";
    }

    if ($today == $endD) {
      $endingSchedules[] = "<li><p style='margin-left: 20px;'>Bed $bedname: $schedName Ending Today</p></li>";
    }
  }
}
?>
<!-- Navigation Bar Fixed Ends -->
<div class="navbar-fixed">
  <nav class="navbar green lighten-0" role="navigation">
    <div class="nav-wrapper container">
      <ul class="right hide-on-med-and-down">
        <li><a class='dropdown-trigger' href='#dropdrown1' data-target='dropdown1'><span class="new badge 
        <?php
        $harvestingCount = (count($harvestingBeds) >= 1) ? count($harvestingBeds) : 0;
        $endingSchedulesCount = (count($endingSchedules) >= 1) ? count($endingSchedules) : 0;
        $totalCount = $harvestingCount + $endingSchedulesCount;
        if ($totalCount != 0) {
          echo "red";
        } else {
          echo "green green-text text-lighten-5";
        }
        ?>
" data-badge-caption="Notification">
              <?php echo $totalCount; ?></span></a></li>
        <li><a class='dropdown-trigger' href='#dropdrown2' data-target='dropdown2'><span class="white-text">
              <?php echo $name; ?>
            </span></a></li>
      </ul>

      <div id='dropdown1' class='notif dropdown-content'>
        <ul>
          <?php

          if (!empty($endingSchedules)) {
            foreach ($endingSchedules as $schedule) {
              echo $schedule;
            }
          }

          if (!empty($harvestingBeds)) {
            foreach ($harvestingBeds as $bed) {
              echo $bed;
            }
          }

          if (empty($harvestingBeds) && empty($endingSchedules)) {
            echo "<li><p style='margin-left: 20px;'>No new notification</p></li>";
          }

          ?>
        </ul>
      </div>
      <!-- Dropdown Structure -->
      <div id='dropdown2' class='dropdown-content'>
        <ul>
          <li><a href="settings.php"><i class="material-icons">settings</i>Settings</a></li>
          <li><a href="../includes/logout.php"><i class="material-icons">exit_to_app</i>Logout</a></li>

        </ul>
      </div>
      <!-- End of Drop down Structure -->

      <a href="#" data-target="slide-out" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
    </div>
  </nav>
</div>


<div class="fixed-action-btn">
  <a class="btn-floating btn green" id="goToTopBtn">
    <i class="large material-icons">arrow_upward</i>
  </a>
</div>


<script>
  const addBedLink = document.getElementById('add-bed');
  const bedsList = document.getElementById('beds');

  function handleDropdownActivation(event) {
    const target = event.currentTarget;
    const listItem = target.parentNode;
    listItem.classList.toggle('active');
  }


  // Load existing beds from database when the page loads
  window.addEventListener('load', () => {
    fetch('../includes/get_beds.php')
      .then(response => response.json())
      .then(beds => {
        bedCount = beds.length;

        // Render existing beds in the HTML
        beds.forEach(beds => {
          const bedHtml = `
          <li id="bed_${beds.bedname}">
            <a class="collapsible-header" onclick="toggleIcon(this)">Beds ${beds.bedname}<i class="material-icons" id="icon1" style="margin-left: 17px;">expand_more</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a href="bed.php?id=${beds.bedname}"><i class="material-icons" style="margin-left: 25px;">computer</i>Gauges</a></li>
                <li><a href="logs.php?id=${beds.bedname}"><i class="material-icons" style="margin-left: 25px;">event_note</i>Logs</a></li>
              </ul>
            </div>
          </li>
        `;
          bedsList.insertAdjacentHTML('beforeend', bedHtml);
        });
      })
      .catch(error => console.error(error));
  });


  let isCodeExecuted = false;

  addBedLink.addEventListener('click', () => {


    if (!isCodeExecuted) {
      // Execute the code here
      // Define the PHP file URL
      const phpFileUrl = '../includes/add_bed.php';

      // Send an AJAX request to the PHP file
      fetch(phpFileUrl, {
        method: 'POST', // Specify the HTTP method
        headers: {
          'Content-Type': 'application/json' // Specify the content type
        },
        body: JSON.stringify({ // Pass any data as an object
          data1: 'value1',
          data2: 'value2'
        })
      })
        .then(response => response.text()) // Get the response as text
        .then(result => {
          console.log(result);
          location.reload();
        })// Log the response
        .catch(error => console.error(error)); // Handle any errors

      // Set the flag to true

      isCodeExecuted = true;
    }


  });

</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    var goToTopBtn = document.getElementById('goToTopBtn');

    // Show or hide the button based on the scroll position
    function toggleGoToTopButton() {
      if (window.pageYOffset > 0) {
        goToTopBtn.style.display = 'block';
      } else {
        goToTopBtn.style.display = 'none';
      }
    }

    // Scroll to the top of the page
    function goToTop() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }

    // Attach event listeners
    goToTopBtn.addEventListener('click', goToTop);
    window.addEventListener('scroll', toggleGoToTopButton);

    // Initial check on page load
    toggleGoToTopButton();
  });
</script>
<script>
  function toggleIcon(header) {
    var icon = header.querySelector('i');
    if (icon.textContent === 'expand_more') {
      icon.textContent = 'expand_less';
    } else {
      icon.textContent = 'expand_more';
    }
  }
</script>



</html>