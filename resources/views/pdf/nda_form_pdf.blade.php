<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>NDA Form</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .agreement-container {
            margin-bottom: 15px;
        }

        .signature-img {
            border: 1px solid #999;
            width: 300px;
            height: auto;
        }

        .label {
            font-weight: bold;
        }

        p {
            text-align: justify;
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">Confidentiality & Non-Circumvention Agreement</h2>

    <div class="agreement-container">
        <h5 class="fw-bold mb-2 m-0">Confidentiality & Non-Circumvention Agreement</h5>

        <p class="nda_para">Seller requires purchaser to supply a confidentiality agreement prior to disclosing any information regarding their business. In consideration of Executive Business Brokers (hereafter the "Broker") providing the undersigned with information of businesses available for sale, I understand and agree to the following:</p>

        <p class="nda_para">1. That any information provided on any business to me by Broker may be sensitive and confidential, and that its disclosure to others may be damaging to the described businesses and their owners.</p>

        <p class="nda_para">2. Not to disclose any information regarding any business introduced to me by the Broker, to any other person who has not also signed and dated this Agreement. Information that is deemed confidential shall include the fact that any such business is for sale, plus any other data provided through the Broker.</p>

        <p class="nda_para">3. Not to contact the respective business owner, employees, suppliers, landlord, competitors, or customers except through the Broker.</p>

        <p class="nda_para">4. Any information provided to me by the Broker with respect to any business was obtained by the seller or other sources and was not verified in any way. I understand and agree that the Broker relied on the seller or such other sources for the accuracy of said information, has no knowledge of the accuracy of said information, and makes no warranty, expressed or implied, as to the accuracy of such information. Understanding that limitation, prior to entering into an agreement to purchase any business, I shall make such independent verification as I deem necessary, of said information. I further agree that the Broker shall not be held liable for any errors, omissions, or misrepresentations in passing on any information that it has received in good faith from any business owners and/or other selling clients, and that it is my responsibility to verify all information. I further agree to indemnify and hold Broker and its employees, agents, and representatives harmless from and against any claims for damages resulting from any errors, omissions, or misrepresentations of the seller or other sources of information regarding any business.</p>

        <p class="nda_para">5. That should I enter into an agreement to purchase a business that was introduced to me by the Broker, I grant to seller the right to obtain, through standard reporting agencies, financial and credit information concerning myself or the affiliates I represent and understand that this information will be held confidential by the seller and Broker and will only be used for the seller extending credit to me.</p>

        <p class="nda_para">6. That all correspondence, inquiries, offers to purchase and negotiations relating to the purchase or lease of any business presented to me or affiliates will be conducted exclusively through Broker. I acknowledge that the Broker has supplied me with a valuable service and if I purchase any business which was supplied by Broker with an attempt to exclude Broker, or interfere with the Broker's contractual right to a commission from the sale of a business, or if I receive any interest in the assets of the business in any shape, manner, or form, regardless of the name, legal capacity, or form of the transferee of the assets or title to the business, without the broker being paid, I shall be personally liable to the Broker for a commission equal to up to ten percent (10%) of the total contract price or a minimum of $15,000, whichever is greater (including non-cash consideration, if any) plus reasonable attorney's fees and costs of suit.</p>

        <p class="nda_para">7. I will not enter into any negotiations for the purchase of any businesses to which the Broker has introduced me without Broker. For a period of one year after we cease to use Broker's services, I will also not enter into any negotiations for the purchase of any businesses to which Broker or any agents of the Broker has introduced to me.</p>

        <p class="nda_para">8. That if I decline to pursue the acquisition of any business/assets/properties Broker has for sale, for whatever reason, I will return all original documents received by Broker and I shall remain bound by the terms of this confidentiality agreement and furthermore, I will not discuss any information received by Broker with any outside parties.</p>

        <p class="nda_para">9. In the event, I violate any of the terms of this Agreement, the Broker shall be entitled to recover reasonable attorney's fees and cost of suit.</p>

        <p class="nda_para">10. This Agreement shall be interpreted and enforced under the laws of the State of New Jersey. The parties hereby consent to jurisdiction in the State of New Jersey and agree that the sole and exclusive forum for litigating any issue arising out of this Agreement shall be the Superior Court of the State of New Jersey. In the event the suit is instituted with regard to any issue arising out of this Agreement, the parties agree to a non-jury trial.</p>

        <p class="fw-bold">ALL OF THE INFORMATION MUST BE COMPLETED IN ORDER TO OBTAIN INFORMATION ON BUSINESS (ES).</p>
    </div>

    <h3>Buyer Details</h3>
    <div class="section">
        <p><span class="label">Full Name:</span> {{ $full_name }}</p>
        <p><span class="label">Business Interest:</span> {{ $business_interest }}</p>
        <p><span class="label">Home Address:</span> {{ $home_address }}</p>
        <p><span class="label">Home Phone:</span> {{ $home_phone }}</p>
        <p><span class="label">Cell Phone:</span> {{ $cell_phone }}</p>
        <p><span class="label">Email:</span> {{ $email }}</p>
        <p><span class="label">Date:</span> {{ $date }}</p>
    </div>

    <div class="section">
        <p><span class="label">Signature:</span></p>
        @if($signature)
        <img class="signature-img" src="{{ $signature }}" alt="Signature" />
        @else
        <p>No signature provided.</p>
        @endif
    </div>

</body>

</html>