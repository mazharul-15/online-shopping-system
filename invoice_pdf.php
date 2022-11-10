<?php
    //including vendor autoload for pdf
    include_once("vendor/autoload.php");
    $css = file_get_contents("invoice_pdf_css.css");

    // Including connection & function .inc.php
    include_once("connection.inc.php");
    include_once("function.inc.php");

    $order_id = get_safe_value($con, $_GET['id']);
    $sql = "SELECT order_detail.*, product.name, product.image FROM order_detail, product
    WHERE order_detail.order_id = $order_id and order_detail.product_id = product.id";

    $res = mysqli_query($con, $sql);

    //for final of all products
    $final_price = 0;
       
    $html = '<table>
                <thead>
                    <tr>
                        <th class="name">Product Name</th>
                        <th class="thumbnail">Product Image</th>
                        <th class="qty"><span class="nobr">Product Qty</span></th>
                        <th class="price"><span class="nobr">Product Price</span></th>
                        <th class="total-price"><span class="nobr">Total Price</span></th>
                    </tr>
                </thead>
                <tbody>';

    while($row = mysqli_fetch_assoc($res)) {
        $total_price = $row['qty'] * $row['price'];
        $final_price += $total_price;
        // prx($row);
        $html .=    '<tr>
                        <td class="name">'.$row['name'].'</td>
                        <td class="thumbnail"><img src="media/product/'.$row['image'].'"></td>
                        <td class="qty">'.$row['qty'].'</td>
                        <td class="price">'.$row['price'].'</td>
                        <td class="total-price">'.$total_price.'</td>
                    </tr>
                    <tr id = "price">
                        <td colspan="3"></td>
                        <td class="price-text">Total Price</td>
                        <td class="total-price">'.$final_price.'</td>
                    </tr>';
    }
    $html .= '</tbody>
            </table>';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($css, 1);
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output();

?>

