
<section class="shipping_policy">
    <div class="card shadow-lg pt-4 pb-4">
        <h2 class="text-primary heading2">Shipping Policy</h2>
        <p class="paragraph1 mb-0">Effective Date: [Insert Date]</p>
        <div class="border-bottom mb-2"></div>
        
        <p class="heading4">
            <b>
                <?php 
                    if ($data && isset($data['name'])) {
                        echo $data['name'];
                    } else {
                        echo 'Name not found';
                    }
                ?>
            </b>
        </p>
        <p class="paragraph1 mb-1">
            Address: 
            <?php 
                if ($data && isset($data['address'])) {
                    echo $data['address'];
                } else {
                    echo 'address not found';
                }
            ?>
        </p>
        <p class="paragraph1 mb-0">Haneri Electricals LLP ("we," "our," or "us") is committed to providing a seamless and efficient shipping experience for all our customers. This Shipping Policy outlines the terms and conditions for the delivery of our products.</p>
        
        <h4 class="m_top heading4 text-primary">1. Shipping Destinations</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">We ship our products across all major cities and towns in India.</li>
            <li class="list-group-item">Delivery services may not be available in remote or non-serviceable areas. Customers in such locations will be notified during the order placement process.</li>
        </ul>
        
        <h4 class="m_top heading4 text-primary">2. Delivery Timelines</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Standard Delivery:</strong> Orders are typically delivered within 5-7 business days from the date of order confirmation.</li>
            <li class="list-group-item"><strong>Express Delivery:</strong> Available in select cities, with delivery within 2-3 business days.</li>
            <li class="list-group-item">Delivery timelines may vary based on location and product availability.</li>
            <li class="list-group-item">Customers will be notified of any delays due to unforeseen circumstances or high demand.</li>
        </ul>
        
        <h4 class="m_top heading4 text-primary">3. Shipping Charges</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Free Shipping:</strong> Shipping charges are included in the finished product cost, and no additional fees are applied. However, spares and component shipping may attract extra charges as per actual for out-of-warranty cases.</li>
            <li class="list-group-item">Any additional packaging request made by the customer will be charged extra as per actual.</li>
        </ul>
        
        <h4 class="m_top heading4 text-primary">4. Order Tracking</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Once an order is shipped, customers will receive a confirmation email or SMS with a tracking ID and link.</li>
            <li class="list-group-item">Customers can use the tracking ID to monitor the shipment status via our logistics partner’s portal.</li>
            <li class="list-group-item">For any tracking issues, please contact our customer support team at <strong>[Insert Contact Information]</strong>.</li>
        </ul>
        
        <h4 class="m_top heading4 text-primary">5. Shipping Restrictions</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">We do not deliver to P.O. Boxes or military addresses (e.g., APO/FPO).</li>
            <li class="list-group-item">Certain products may have shipping restrictions due to legal or regulatory requirements. Such restrictions will be communicated at the time of purchase.</li>
        </ul>
        
        <h4 class="m_top heading4 text-primary">6. Damaged or Lost Shipments</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>If a product arrives damaged:</strong>
                <ul>
                    <li>Customers must notify our customer support team within 48 hours of delivery.</li>
                    <li>Provide photographic evidence of the damaged product and packaging.</li>
                    <li>We will arrange for a replacement or refund after verifying the issue.</li>
                </ul>
            </li>
            <li class="list-group-item"><strong>For lost shipments:</strong>
                <ul>
                    <li>If an order is not received within the expected delivery time, customers must contact our support team immediately.</li>
                    <li>We will investigate with our logistics partner and provide a resolution within 15 working days.</li>
                </ul>
            </li>
        </ul>
        
        <h4 class="m_top heading4 text-primary">7. Cancellation of Orders</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Orders can be cancelled before they are shipped. Once shipped, cancellations are not allowed.</li>
            <li class="list-group-item">To cancel an order, contact Haneri Customer Support at 
                <a href="mailto:<?php echo $data['email']; ?>">
                    <?php 
                        if ($data && isset($data['email'])) {
                            echo $data['email'];
                        } else {
                            echo 'email not found';
                        }
                    ?>
                </a>
            </li>
            <li class="list-group-item">Refunds for cancelled orders will be processed within <strong>[Insert Time Period, e.g., 7-10 business days]</strong>.</li>
        </ul>
        
        <h4 class="m_top heading4 text-primary">8. Contact Us</h4>
        <p class="paragraph1 mb-1">For any shipping-related queries or concerns, please contact:</p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Haneri Customer Support</strong></li>
            <li class="list-group-item">
                Phone: 
                <?php 
                    if ($data && isset($data['phone'])) {
                        echo $data['phone'];
                    } else {
                        echo 'phone not found';
                    }
                ?>    
            </li>
            <li class="list-group-item">Email: 
                <a href="mailto:<?php echo $data['email']; ?>">
                    <?php 
                        if ($data && isset($data['email'])) {
                            echo $data['email'];
                        } else {
                            echo 'email not found';
                        }
                    ?>
                </a>
            </li>
            <li class="list-group-item">Office Address: 
                <?php 
                    if ($data && isset($data['address'])) {
                        echo $data['address'];
                    } else {
                        echo 'address not found';
                    }
                ?>
            </li>
        </ul>
        
        <p class="heading4 mb-1 mt-1 text-primary">Haneri Electricals LLP reserves the right to update this Shipping Policy at its discretion. Any changes will be communicated via our website or official communication channels.</p>
        <p class="heading4 mb-1 mt-1 text-primary text-center">Thank you for choosing Haneri. We are dedicated to ensuring your products reach you swiftly and safely.</p>
    </div>
</section>