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

  .invi {
    display: none;
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
  <li <?php if (basename($_SERVER['PHP_SELF']) == 'report.php') {
    echo ' class="active"';
  } ?>><a
      href="https://docs.google.com/document/u/0/" target="_blank"><i class="material-icons">description</i>Report</a>
  </li>

  <li <?php if (basename($_SERVER['PHP_SELF']) == 'users.php') {
    echo ' class="active"';
  } ?>><a href="users.php"><i
        class="material-icons">manage_accounts</i>Users</a></li>
  <li <?php if (basename($_SERVER['PHP_SELF']) == 'activate.php') {
    echo ' class="active"';
  } ?>><a href="activate.php"><i
        class="material-icons">person_remove</i>Deactivated Users</a></li>

  <li id="online" <?php if (basename($_SERVER['PHP_SELF']) == 'active.php') {
    echo ' class="active"';
  } ?>><a
      href="active.php"><i class="material-icons">groups</i>Who's Online</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li class="no-padding">
  <li><a class="subheader">Monitoring</a></li>

  <ul id="beds" class="collapsible collapsible-accordion">

  </ul>

  </li>
  <li><a id="add-bed" href="#"><i class="material-icons">add</i>Add Bed</a></li>
  <li <?php if (basename($_SERVER['PHP_SELF']) == 'manage_beds.php') {
    echo ' class="active"';
  } ?>><a
      href="../includes/delete_beds.php"><i class="material-icons">delete</i>Delete Beds</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li class="no-padding">
  <li><a class="subheader">Settings</a></li>
  <li <?php if (basename($_SERVER['PHP_SELF']) == 'gallery.php') {
    echo ' class="active"';
  } ?>><a href="gallery.php"><i
        class="material-icons">images</i>Image Setting</a></li>
  <li <?php if (basename($_SERVER['PHP_SELF']) == 'settings.php') {
    echo ' class="active"';
  } ?>><a href="settings.php"><i
        class="material-icons">settings</i>User Settings</a></li>
  <li <?php if (basename($_SERVER['PHP_SELF']) == 'home-setting.php') {
    echo ' class="active"';
  } ?>><a href="home-setting.php"><i
        class="material-icons">settings</i>Homepage Settings</a></li>
  <li <?php if (basename($_SERVER['PHP_SELF']) == 'faq.php') {
    echo ' class="active"';
  } ?>><a href="faq.php"><i
        class="material-icons">question_answer</i>FAQ</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li><a href="../includes/logout.php"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>
<!-- PHP CODES -->
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
<!-- END PHP CODES -->
<!-- Navigation Bar Fixed Ends -->
<div class="navbar-fixed">
  <nav class="navbar green lighten-0" role="navigation">
    <div class="nav-wrapper container">
      <ul class="right hide-on-med-and-down">
        <li>&nbsp</li>
        <li><a class='dropdown-trigger' href='#dropdrown2' data-target='dropdown2'><span class="white-text">
              <?php echo $name; ?>
            </span></a></li>
      </ul>
      <!-- Dropdown Structure -->
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
      <?php
      $harvestingCount = (count($harvestingBeds) >= 1) ? count($harvestingBeds) : 0;
      $endingSchedulesCount = (count($endingSchedules) >= 1) ? count($endingSchedules) : 0;
      $totalCount = $harvestingCount + $endingSchedulesCount;
      ?>
      <a href="#" data-target="slide-out" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
      <a href="#" data-target="dropdown1" class="dropdown-trigger right"><i class="material-icons" <?php if ($totalCount >= 1) {
        echo "style='color: red;'";
      } else {
        echo "style='color: white;'";
      } ?>> <?php

       if ($totalCount >= 1) {
         echo "notifications_active";
       } else {
         echo "notifications";
       } ?> </i></a>
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


  window.addEventListener('load', () => {
    fetch('../includes/get_beds.php')
      .then(response => response.json())
      .then(beds => {
        bedCount = beds.length;

        // Render existing beds in the HTML
        beds.forEach(bed => {
          const isActive = bed.bedname === getParameterByName('id'); // Check if the bed is active
          const activeClass = isActive ? 'active' : ''; // Apply the active class if it matches the 'id' parameter in the URL

          const bedHtml = `
          <li id="${bed.bedname}" class="${activeClass}">
            <a class="collapsible-header" onclick="toggleIcon(this)">Beds ${bed.bedname}<i class="material-icons" id="icon1" style="margin-left: 17px;">expand_more</i></a>
            <div class="collapsible-body">
              <ul>
                <li id="gauges${bed.bedname}" class="${isActivePage('bed.php', bed.bedname) ? 'active' : ''}">
                  <a href="bed.php?id=${bed.bedname}"><i class="material-icons" style="margin-left: 25px;">speed</i>Gauges</a>
                </li>
                <li id="logs${bed.bedname}" class="${isActivePage('logs.php', bed.bedname) ? 'active' : ''}">
                  <a href="logs.php?id=${bed.bedname}"><i class="material-icons" style="margin-left: 25px;">content_paste</i>Logs</a>
                </li>
                <li id="schedules${bed.bedname}" class="${isActivePage('schedules.php', bed.bedname) ? 'active' : ''}">
                  <a href="schedules.php?id=${bed.bedname}"><i class="material-icons" style="margin-left: 25px;">schedule</i>Schedules</a>
                </li>
              </ul>
            </div>
          </li>
        `;
          bedsList.insertAdjacentHTML('beforeend', bedHtml);
        });

        // Initialize collapsible components
        const collapsibleElems = document.querySelectorAll('.collapsible');
        M.Collapsible.init(collapsibleElems, {});

        function isActivePage(page, bedname) {
          const currentPage = window.location.pathname.split('/').pop();
          const id = getParameterByName('id');
          return currentPage === page && id === bedname;
        }

        function getParameterByName(name) {
          const url = window.location.href;
          name = name.replace(/[\[\]]/g, '\\$&');
          const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
          const results = regex.exec(url);
          if (!results) return null;
          if (!results[2]) return '';
          return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        // Check if the current page is one of the bed-related pages, and if not, expand the first bed dropdown by default
        const currentPage = window.location.pathname.split('/').pop();
        if (!['bed.php', 'logs.php', 'schedules.php'].includes(currentPage)) {
          const firstBed = beds[0];
          const firstBedDropdown = document.getElementById(firstBed.bedname);
          const firstBedCollapsible = M.Collapsible.getInstance(firstBedDropdown);
          firstBedCollapsible.open();
        }
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
    // Scroll to the active class position
    var activeDropdown = document.querySelector('.sidenav li.active ');
    if (activeDropdown) {
      activeDropdown.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }

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