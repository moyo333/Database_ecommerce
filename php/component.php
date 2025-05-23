 <?php

require_once("php/CreateDb.php");
require_once("php/component.php");

// Create instance of CreateDb class
$db = new CreateDb("productdb", "productdb");

function component($productname, $productprice, $productimg, $productid) {
    // Sanitize input to avoid XSS issues
    $productname = htmlspecialchars($productname);
    $productprice = htmlspecialchars($productprice);
    $productimg = htmlspecialchars($productimg);

    $element = "
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
        <form action=\"index.php\" method=\"post\">
            <div class=\"card shadow\">
                <img src=\"$productimg\" alt=\"Image of $productname\" class=\"img-fluid card-img-top\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">$productname</h5>
                    <h6>
                        <i class=\"fa fa-star\"></i>
                        <i class=\"fa fa-star\"></i>
                        <i class=\"fa fa-star\"></i>
                        <i class=\"fa fa-star-half-o\"></i>
                        <i class=\"fa fa-star-o\"></i>
                    </h6>
                    <p>The message about the product</p>
                    <h5>
                        <small><s class=\"text-primary\">R2000</s></small>
                        <span class=\"price\">$productprice</span>
                    </h5>
                    <button type=\"submit\" name=\"add\" class=\"btn btn-warning my-3\">
                        Add to Cart <i class=\"fa fa-shopping-cart\"></i>
                    </button>
                    <input type=\"hidden\" name=\"product_id\" value=\"$productid\">
                </div>
            </div>
        </form>
    </div>";
    
    echo $element;
}

function cartElement($productname, $productprice, $productimg, $productid) {
    $element = "
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
        <div class=\"border rounded p-3\">
            <div class=\"row bg-white align-items-center\">
                <div class=\"col-md-3\">
                    <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid\">
                </div>
                <div class=\"col-md-6\">
                    <h5 class=\"pt-2\">$productname</h5>
                    <small class=\"text-secondary\">Seller: Daily Tuition</small>
                    <h5 class=\"pt-2\">R$productprice</h5>
                    <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                </div>
                <div class=\"col-md-3 py-3\">
                    <button type=\"button\" class=\"btn bg-light border rounded-circle\">
                        <i class=\"fas fa-minus\"></i>
                    </button>
                    <input type=\"text\" value=\"1\" class=\"form-control d-inline w-25 text-center\">
                    <button type=\"button\" class=\"btn bg-light border rounded-circle\">
                        <i class=\"fas fa-plus\"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>";
    
    echo $element;
}
?>