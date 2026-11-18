<h2>Fuel Menu</h2>
<?php
$soldOut = 0;

// outer foreach: one table per category
foreach ($categories as $cat) {
    echo "<h3>" . $cat . "</h3>";
    echo "<table>";

    // supplements have a different table header
    if ($cat == "Supplements") {
        echo "<tr><th>Code</th><th>Supplement</th><th>Benefit</th><th>Price</th><th>Stock</th></tr>";
    } else {
        echo "<tr><th>Code</th><th>Item</th><th>Protein</th><th>Carbs</th><th>Cal</th><th>Price</th><th>Stock</th></tr>";
    }

    // inner foreach: only the products of this category
    foreach ($products as $code => $item) {
        if ($item["category"] != $cat) {
            continue;
        }

        // stock label
        if ($item["stock"] == 0) {
            $stockText = '<span class="error">Sold out</span>';
            $soldOut++;
        } elseif ($item["stock"] <= 5) {
            $stockText = '<span class="low">Only ' . $item["stock"] . ' left</span>';
        } else {
            $stockText = $item["stock"] . ' pcs';
        }

        echo "<tr>";
        echo "<td>" . $code . "</td>";
        echo "<td>" . $item["name"] . "</td>";
        if ($cat == "Supplements") {
            echo "<td>" . $item["note"] . "</td>";
        } else {
            echo "<td>" . $item["protein"] . "g</td>";
            echo "<td>" . $item["carbs"] . "g</td>";
            echo "<td>" . $item["cal"] . "</td>";
        }
        echo "<td>&#8369;" . number_format($item["price"], 2) . "</td>";
        echo "<td>" . $stockText . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
<p class="box">Sold out today: <?php echo $soldOut; ?> item(s).<br>
Supplements are not medicine. Talk to a doctor first if you have a health condition, take medication or are pregnant.</p>
