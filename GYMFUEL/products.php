<?php
// products.php
// all the store data is here, the other pages use require to get it

$storeName = "IronFuel Gym Pantry";
$openDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

// the menu is grouped by these categories
$categories = ["Meals", "Shakes", "Snacks", "Supplements"];

// price, protein (g), carbs (g), calories, stock, note
$products = [
    // meals (protein + rice or carbs)
    "ML1" => ["name" => "Chicken Breast & White Rice", "category" => "Meals", "price" => 135, "protein" => 50, "carbs" => 45, "cal" => 440, "stock" => 20, "note" => ""],
    "ML2" => ["name" => "Salmon & Brown Rice", "category" => "Meals", "price" => 210, "protein" => 45, "carbs" => 45, "cal" => 575, "stock" => 4, "note" => ""],
    "ML3" => ["name" => "Lean Beef & White Rice", "category" => "Meals", "price" => 175, "protein" => 54, "carbs" => 45, "cal" => 530, "stock" => 0, "note" => ""],
    "ML4" => ["name" => "Chicken & Sweet Potato", "category" => "Meals", "price" => 140, "protein" => 49, "carbs" => 40, "cal" => 420, "stock" => 15, "note" => ""],
    "ML5" => ["name" => "Tuna & Rice Bowl", "category" => "Meals", "price" => 120, "protein" => 40, "carbs" => 45, "cal" => 360, "stock" => 18, "note" => ""],
    "ML6" => ["name" => "Tofu & Brown Rice (Veggie)", "category" => "Meals", "price" => 110, "protein" => 25, "carbs" => 55, "cal" => 395, "stock" => 12, "note" => ""],
    "ML7" => ["name" => "Egg Whites & Oats Bowl", "category" => "Meals", "price" => 95, "protein" => 27, "carbs" => 27, "cal" => 250, "stock" => 10, "note" => ""],

    // shakes
    "SH1" => ["name" => "Whey Protein Shake", "category" => "Shakes", "price" => 120, "protein" => 30, "carbs" => 8, "cal" => 180, "stock" => 15, "note" => ""],
    "SH2" => ["name" => "Whey + Creatine Shake", "category" => "Shakes", "price" => 140, "protein" => 30, "carbs" => 8, "cal" => 190, "stock" => 12, "note" => ""],
    "SH3" => ["name" => "Mass Gainer Shake", "category" => "Shakes", "price" => 150, "protein" => 40, "carbs" => 90, "cal" => 650, "stock" => 8, "note" => ""],

    // snacks
    "SN1" => ["name" => "Protein Bar (Choco Peanut)", "category" => "Snacks", "price" => 65, "protein" => 20, "carbs" => 22, "cal" => 210, "stock" => 25, "note" => ""],
    "SN2" => ["name" => "Greek Yogurt Cup", "category" => "Snacks", "price" => 55, "protein" => 15, "carbs" => 8, "cal" => 110, "stock" => 20, "note" => ""],
    "SN3" => ["name" => "Banana & Peanut Butter", "category" => "Snacks", "price" => 45, "protein" => 7, "carbs" => 35, "cal" => 250, "stock" => 14, "note" => ""],

    // supplements
    "SU1" => ["name" => "Fish Oil (Omega-3) 2 caps", "category" => "Supplements", "price" => 45, "protein" => 0, "carbs" => 0, "cal" => 0, "stock" => 50, "note" => "Heart and joint support"],
    "SU2" => ["name" => "BCAA 7g", "category" => "Supplements", "price" => 60, "protein" => 0, "carbs" => 0, "cal" => 0, "stock" => 30, "note" => "Workout recovery"],
    "SU3" => ["name" => "Creatine Monohydrate 5g", "category" => "Supplements", "price" => 30, "protein" => 0, "carbs" => 0, "cal" => 0, "stock" => 40, "note" => "Strength and power"],
    "SU4" => ["name" => "Multivitamin", "category" => "Supplements", "price" => 25, "protein" => 0, "carbs" => 0, "cal" => 0, "stock" => 60, "note" => "Fills nutrient gaps"],
    "SU5" => ["name" => "Pre-Workout (with caffeine)", "category" => "Supplements", "price" => 70, "protein" => 0, "carbs" => 0, "cal" => 0, "stock" => 3, "note" => "Energy, 18 and up only"],
    "SU6" => ["name" => "Calcium + Vitamin D3", "category" => "Supplements", "price" => 35, "protein" => 0, "carbs" => 0, "cal" => 0, "stock" => 25, "note" => "Bone health"],
    "SU7" => ["name" => "L-Glutamine 5g", "category" => "Supplements", "price" => 50, "protein" => 0, "carbs" => 0, "cal" => 0, "stock" => 0, "note" => "Recovery support"],
];

// fitness goals: protein target and calorie range for ONE set (meal + extras)
$goals = [
    "bulk" => [
        "label" => "Bulking",
        "focus" => "Build muscle with extra calories",
        "protein" => 70, "calMin" => 800, "calMax" => 2000,
        "meal" => "Chicken & White Rice + Mass Gainer",
        "stack" => "Creatine + Fish Oil + Multivitamin"
    ],
    "cut" => [
        "label" => "Cutting",
        "focus" => "Lose fat and keep your muscle",
        "protein" => 45, "calMin" => 250, "calMax" => 600,
        "meal" => "Salmon & Brown Rice or Chicken & White Rice",
        "stack" => "BCAA + Fish Oil + Multivitamin"
    ],
    "recomp" => [
        "label" => "Body Recomp",
        "focus" => "Lose fat and gain muscle at the same time",
        "protein" => 55, "calMin" => 500, "calMax" => 750,
        "meal" => "Chicken & Sweet Potato + Whey Shake",
        "stack" => "Creatine + BCAA + Fish Oil"
    ],
    "maintain" => [
        "label" => "Maintaining",
        "focus" => "Keep your current body",
        "protein" => 35, "calMin" => 400, "calMax" => 700,
        "meal" => "Any meal + Protein Bar",
        "stack" => "Multivitamin + Fish Oil + Calcium D3"
    ],
];
?>
