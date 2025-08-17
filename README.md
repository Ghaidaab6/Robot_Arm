# Robot_Arm

🤖 Robot Arm Control Web Panel

This project is a simple web-based control panel for a robot arm.
It allows you to:

Adjust motor angles (sliders for Motor1–Motor6).

Save poses in a pose table.

Send the current pose which run to the run table.

Retrieve the current run pose for a robot controller via PHP.

Mark a run as completed.

📂 Project Structure
/robot-arm-control
│── index.html           # Main frontend (sliders, buttons, table)
│── db.php               # Database connection
│── save_pose.php        # Save current pose to "pose" table
│── get_poses.php        # List all saved poses
│── load_pose.php        # Load one pose by ID
│── remove_pose.php      # Delete a pose by ID
│── run_sequence.php     # Insert/Update current pose into "run" table
│── get_run_pose.php     # Print current run pose {status, m1..m6}
│── update_status.php    # Mark current run as completed (set status = 0).
└── README.md            # Documentation

🗄 Database Setup

Create a database (robot_arm) and run:

CREATE TABLE pose (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motor1 INT NOT NULL,
    motor2 INT NOT NULL,
    motor3 INT NOT NULL,
    motor4 INT NOT NULL,
    motor5 INT NOT NULL,
    motor6 INT NOT NULL
);

CREATE TABLE run (
    motor1 INT NOT NULL,
    motor2 INT NOT NULL,
    motor3 INT NOT NULL,
    motor4 INT NOT NULL,
    motor5 INT NOT NULL,
    motor6 INT NOT NULL,
    status TINYINT DEFAULT 1
);


⚠️ The run table only ever holds one record.
When "Run" is clicked, the table is updated with the current pose.

⚙️ PHP Files
db.php

Database connection settings. Update with your MySQL credentials:

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "robot_arm";

save_pose.php
Saves the current slider values into the pose table.

get_poses.php
Fetches all poses for display in the table.

load_pose.php
Loads one pose by ID and applies it to sliders.

remove_pose.php
Deletes a pose by ID.

run_sequence.php
Inserts or updates the single record in the run table with current slider values.

get_run_pose.php
Returns the run record in format:
   {status:0, m1:90, m2:43, m3:139, m4:90, m5:13, m6:90}


update_status.php

Sets status = 0 in run table after execution.
Prints:
Record updated successfully


🌐 Frontend (index.html)

Six range sliders (0–180°) for Motor1–Motor6.
Reset → resets sliders to default 90.
Save Pose → saves into pose table.
Run → sends current slider values into run table.
Pose Table → shows saved poses with options to Load or Remove.

🚀 Usage Flow

Open index.html in browser. (localhost/info/index.html)

Adjust sliders to define a pose.
Click Save Pose to store it in DB.
Click Run → inserts/updates the single record in run table.

Robot/microcontroller calls:
get_run_pose.php → fetch current pose.

Executes movement.
Calls update_status.php → mark as completed.


✅ Example Output

get_run_pose.php

{status:0, m1:90, m2:43, m3:139, m4:90, m5:13, m6:90}


update_status.php

Record updated successfully

🛠 Requirements

PHP 7+

MySQL / phpMyAdmin

Apache/Nginx server (XAMPP)

📌 Notes

pose = library of saved positions.

run = only one active pose, always overwritten when Run is clicked.

Robot controller should poll get_run_pose.php and call update_status.php after executing.
