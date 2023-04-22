<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card" id="printDiv">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <img src="img/logo.png" style="height: 60px"/>
                    </div>
                    <div class="col-md-6 mb-3 text-right">
                        <span class="display-4"><b>INVOICE</b></span>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Bill To:</strong></p>
                        <p><?= $utils->getValue($responseInvoice, "fname") . ' ' . $utils->getValue($responseInvoice, "lname") ?></p>
                        <p><?= $utils->getValue($responseInvoice, "email") ?></p>
                        <p><?= $utils->getValue($responseInvoice, "billing_address") ?></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p><strong>Invoice Number:</strong> <?= $utils->getValue($responseInvoice, "idinvoice") ?></p>
                        <p><strong>Invoice
                                Date:</strong> <?= date('M d, Y h:i A', strtotime($utils->getValue($responseInvoice, "date"))) ?>
                        </p>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= $utils->getValue($responseInvoice, "title") . '(' . $utils->getValue($responseInvoice, "postID") .''.(($utils->getValue($responseInvoice, "type")=="select_bid")?" - Bid":"").')' ?></td>
                        <td><?= $utils->getValue($responseInvoice, "qty") ?></td>
                        <td><?= number_format($utils->getValue($responseInvoice, "sub_total"), 2) ?></td>
                        <td class="text-right"><?= number_format($utils->getValue($responseInvoice, "sub_total"), 2) ?></td>
                    </tr>
                    <tr>
                        <td>Discount (<?= $utils->getValue($responseInvoice, "discount_percentage") ?>%)</td>
                        <td></td>
                        <td><?= number_format($utils->getValue($responseInvoice, "discount_amount"), 2) ?></td>
                        <td class="text-right"><?= number_format($utils->getValue($responseInvoice, "discount_amount"), 2) ?></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Sub Total</th>
                        <td class="text-right <?=(empty($utils->getValue($responseInvoice, "delivery_amount")))?'double-line-bottom':''?>"><?= number_format(($utils->getValue($responseInvoice, "sub_total")-$utils->getValue($responseInvoice, "discount_amount")), 2) ?></td>
                    </tr>
                    <?php
                    if (!empty($utils->getValue($responseInvoice, "delivery_amount"))) {
                        ?>
                        <tr>
                            <th colspan="3" class="text-right">Delivery Fee</th>
                            <td class="text-right"><?= number_format($utils->getValue($responseInvoice, "delivery_amount"), 2) ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <td class="text-right double-line-bottom"><?= number_format($utils->getValue($responseInvoice, "total"), 2) ?></td>
                        </tr>
                    <?php }?>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <a href="marcket-place.php" class="btn btn-success"><i class="fa fa-arrow-left"></i> Go to Market Place</a>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-success" onclick="PrintElem('printDiv')">Print <iclass="fa fa-print"></i></button>
            </div>
        </div>
    </div>
</div>