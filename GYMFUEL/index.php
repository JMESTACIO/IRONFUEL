<?php include 'header.php'; ?>
<?php require 'products.php'; ?>
<?php
$today = date("l");
$isOpen = in_array($today, $openDays);

// switch: today's training split and what to eat
switch ($today) {
    case "Monday":
        $split = "Chest + Triceps";
        $tip = "Chicken Breast & White Rice with a Whey Shake.";
        break;
    case "Tuesday":
        $split = "Back + Biceps";
        $tip = "Salmon & Brown Rice with Fish Oil.";
        break;
    case "Wednesday":
        $split = "Leg Day";
        $tip = "Chicken & Sweet Potato with a Mass Gainer Shake.";
        break;
    case "Thursday":
        $split = "Shoulders + Abs";
        $tip = "Tuna & Rice Bowl with BCAA.";
        break;
    case "Friday":
        $split = "Full Body";
        $tip = "Lean Beef & White Rice with Creatine.";
        break;
    case "Saturday":
        $split = "Cardio + Core";
        $tip = "Egg Whites & Oats Bowl with a Protein Bar.";
        break;
    default:
        $split = "Rest Day";
        $tip = "Pantry is closed, do some meal prep.";
}
?>

<h2>Today's Workout Split</h2>
<div class="stats">
    <div class="stat"><b><?php echo $split; ?></b><span>Split for <?php echo $today; ?></span></div>
    <div class="stat"><b><?php echo $isOpen ? "OPEN" : "CLOSED"; ?></b><span>Pantry status</span></div>
    <div class="stat"><b><?php echo count($products); ?></b><span>Items on menu</span></div>
</div>
<p class="box">Coach tip: <?php echo $tip; ?></p>

<h2>Pick Your Goal</h2>
<p>For all ages and all levels, from first-timers to lifters. Pick the goal that fits you.</p>
<table>
    <tr>
        <th>Goal</th>
        <th>Focus</th>
        <th>Target per set</th>
        <th>Best meal</th>
        <th>Supplement stack</th>
    </tr>
    <?php
    foreach ($goals as $g) {
        echo "<tr>";
        echo "<td><b>" . $g["label"] . "</b></td>";
        echo "<td>" . $g["focus"] . "</td>";
        echo "<td>" . $g["protein"] . "g protein<br>" . $g["calMin"] . "-" . $g["calMax"] . " cal</td>";
        echo "<td>" . $g["meal"] . "</td>";
        echo "<td>" . $g["stack"] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php include 'menu.php'; ?>

<h3>Rest timer before your next set</h3>
<p>
<?php
// do...while loop, counts down every 15 seconds
$seconds = 60;
do {
    echo $seconds . "s... ";
    $seconds -= 15;
} while ($seconds > 0);
?>
</p>
<p class="success">Rest over, go lift!</p>

<h2>Build Your Order</h2>
<form method="POST" action="process.php">
    <label>Name</label>
    <input name="customer_name" required>

    <label>Age</label>
    <input name="age" type="number" min="12" max="90" required>

    <label>Customer Type</label>
    <select name="customer_type">
        <option value="member">Gym Member (10% off)</option>
        <option value="student">Student (5% off)</option>
        <option value="senior">Senior Citizen (20% off)</option>
        <option value="guest">Walk-in Guest</option>
    </select>

    <label>Fitness Goal</label>
    <select name="goal">
        <?php
        foreach ($goals as $key => $g) {
            echo '<option value="' . $key . '">' . $g["label"] . '</option>';
        }
        ?>
    </select>

    <label>Meal</label>
    <select name="meal">
        <?php
        foreach ($products as $code => $item) {
            if ($item["category"] != "Meals") {
                continue;
            }
            $disabled = ($item["stock"] == 0) ? " disabled" : "";
            echo '<option value="' . $code . '"' . $disabled . '>';
            echo $item["name"] . " (" . $item["protein"] . "g protein) - Php " . $item["price"];
            echo '</option>';
        }
        ?>
    </select>

    <label>Shake or Snack (optional)</label>
    <select name="extra">
        <option value="none">No shake or snack</option>
        <?php
        foreach ($products as $code => $item) {
            if ($item["category"] != "Shakes" && $item["category"] != "Snacks") {
                continue;
            }
            $disabled = ($item["stock"] == 0) ? " disabled" : "";
            echo '<option value="' . $code . '"' . $disabled . '>';
            echo $item["name"] . " (" . $item["protein"] . "g protein) - Php " . $item["price"];
            echo '</option>';
        }
        ?>
    </select>

    <label>Supplement (optional)</label>
    <select name="supplement">
        <option value="none">No supplement</option>
        <?php
        foreach ($products as $code => $item) {
            if ($item["category"] != "Supplements") {
                continue;
            }
            $disabled = ($item["stock"] == 0) ? " disabled" : "";
            echo '<option value="' . $code . '"' . $disabled . '>';
            echo $item["name"] . " - Php " . $item["price"];
            echo '</option>';
        }
        ?>
    </select>

    <label>Number of sets (max 10)</label>
    <select name="quantity">
        <?php
        for ($q = 1; $q <= 10; $q++) {
            echo '<option value="' . $q . '">' . $q . '</option>';
        }
        ?>
    </select>

    <label>Budget (PHP)</label>
    <input name="budget" type="number" min="0" step="0.01" required>

    <button type="submit">Process Order</button>
</form>
<?php include 'footer.php'; ?>
