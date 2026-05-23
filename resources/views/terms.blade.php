<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Terms & Conditions - Russ Cuevas Artelier</title>
    
    @vite(['resources/css/styles2.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body style="background-color: #ffffff; color: #333; overflow-x: hidden;">
    
    <x-nav-bar></x-nav-bar>

    <!-- Header Section -->
    <section style="background-color: #faf9f6; padding: 120px 20px 80px; text-align: center; border-bottom: 1px solid #eee;">
        <div style="max-width: 800px; margin: 0 auto;">
            <span style="font-family: var(--font-sans); text-transform: uppercase; letter-spacing: 4px; font-size: 0.7rem; color: #888; display: block; margin-bottom: 20px;">Legal Information</span>
            <h1 style="font-family: var(--font-serif); font-size: clamp(2.5rem, 8vw, 4rem); font-weight: 400; margin-bottom: 30px; letter-spacing: -1px; color: #1a1a1a;">Terms & Conditions</h1>
            <p style="font-family: var(--font-sans); font-size: 1.1rem; color: #666; line-height: 1.8; font-style: italic;">"The foundation of our relationship with you."</p>
        </div>
    </section>

    <!-- Content Section -->
    <main style="max-width: 1000px; margin: 0 auto; padding: 40px 20px 80px;">
        <div style="background-color: #ffffff; border: 1px solid #f0f0f0; border-radius: 2px; padding: 60px 50px; box-shadow: 0 30px 60px rgba(0,0,0,0.02); position: relative; margin-top: -40px; z-index: 10;">
            
            <div style="font-family: var(--font-sans); font-size: 1.15rem; line-height: 1.7; color: #444;">
                
                <div style="margin-bottom: 50px; text-align: center; border-left: 4px solid #c5a48e; padding: 15px 30px; background-color: #fffdfb;">
                    <p style="font-size: 1.25rem; color: #1a1a1a; font-family: var(--font-serif); font-style: italic; line-height: 1.6;">
                        "Welcome to the world of Russ Cuevas. It is our distinct honor to accompany you on your journey toward a bespoke creation. The following terms are designed to ensure that your experience with our Artelier is as seamless and beautiful as the garments we create."
                    </p>
                </div>

                <p style="margin-bottom: 40px; font-size: 1.2rem; color: #1a1a1a; font-weight: 500;">
                    These Terms and Conditions govern the professional relationship between Russ Cuevas Atelier ("the Atelier") and our esteemed clients. By engaging our bespoke services or utilizing our digital platform, you acknowledge and agree to the following standards of excellence.
                </p>

                <!-- 1. General Engagement -->
                <div style="margin-bottom: 45px;">
                    <h2 style="font-family: var(--font-serif); font-size: 1.85rem; color: #1a1a1a; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">1. General Engagement</h2>
                    <p style="margin-bottom: 15px;">1.1 Each Russ Cuevas creation is a bespoke work of art, handcrafted to the specific measurements, aesthetic preferences, and design requirements of the client.</p>
                    <p>1.2 A formal engagement begins only upon the receipt of the initial deposit and the execution of our comprehensive service agreement.</p>
                </div>

                <!-- 2. Bookings & Appointments -->
                <div style="margin-bottom: 45px;">
                    <h2 style="font-family: var(--font-serif); font-size: 1.85rem; color: #1a1a1a; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">2. Bookings & Consultations</h2>
                    <p style="margin-bottom: 15px;">2.1 To preserve the intimate and focused nature of our craft, all consultations and fittings are conducted strictly by appointment at our Atelier in Kalookan, Metro Manila.</p>
                    <p style="margin-bottom: 15px;">2.2 <strong>Punctuality:</strong> We value your time and ask for the same in return. Clients are requested to arrive at their scheduled time. Late arrivals may result in a shortened session to maintain the schedule of subsequent patrons.</p>
                    <p>2.3 <strong>Cancellations:</strong> We kindly request a minimum of 48 hours' notice for any rescheduling. Consistent late cancellations or no-shows may require a non-refundable booking fee for future sessions.</p>
                </div>

                <!-- 3. Financial Terms & Refunds -->
                <div style="margin-bottom: 45px;">
                    <h2 style="font-family: var(--font-serif); font-size: 1.85rem; color: #1a1a1a; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">3. Payments, Deposits & Refunds</h2>
                    <p style="margin-bottom: 15px;">3.1 <strong>Initial Commitment:</strong> A non-refundable deposit of 50% of the total estimated value is required to initiate the design process, secure fabric allocations, and begin pattern construction.</p>
                    <p style="margin-bottom: 15px;">3.2 <strong>Progressive Payments:</strong> Milestones and payment schedules are detailed within your specific contract. All balances must be settled in full prior to the final release of the garment.</p>
                    <p>3.3 <strong>Refund Policy:</strong> Due to the highly personalized and bespoke nature of our work, all payments are non-refundable. Should a client choose to discontinue the process, any payments made will be retained by the Atelier to cover the costs of labor, specialized fabrics, and overhead incurred.</p>
                </div>

                <!-- 4. The Fitting Journey -->
                <div style="margin-bottom: 45px;">
                    <h2 style="font-family: var(--font-serif); font-size: 1.85rem; color: #1a1a1a; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">4. Alterations & Fittings</h2>
                    <p style="margin-bottom: 15px;">4.1 Achieving the perfect silhouette typically requires a journey of 3 to 5 intimate fittings. We ask our clients to provide the intended footwear and undergarments for every fitting to ensure precision in length and structure.</p>
                    <p style="margin-bottom: 15px;">4.2 <strong>Design Evolution:</strong> While we welcome collaboration, significant design changes requested after the initial pattern-making or fabric cutting phase will incur additional artisanal and material fees.</p>
                    <p>4.3 <strong>Measurements:</strong> The Atelier is dedicated to the measurements taken during the initial consultation. We cannot be held responsible for fit discrepancies resulting from significant weight fluctuations after the final measurements have been confirmed.</p>
                </div>

                <!-- 5. Intellectual Property -->
                <div style="margin-bottom: 45px;">
                    <h2 style="font-family: var(--font-serif); font-size: 1.85rem; color: #1a1a1a; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">5. Intellectual Property</h2>
                    <p style="margin-bottom: 15px;">5.1 All original designs, sketches, patterns, and technical drawings created by Russ Cuevas remain the exclusive intellectual property of the Atelier.</p>
                    <p>5.2 The unauthorized reproduction or commercial utilization of our unique designs is strictly prohibited and protected by international copyright laws.</p>
                </div>

                <!-- 6. Usage Rights & Media -->
                <div style="margin-bottom: 45px;">
                    <h2 style="font-family: var(--font-serif); font-size: 1.85rem; color: #1a1a1a; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">6. Usage Rights & Portfolio</h2>
                    <p style="margin-bottom: 15px;">6.1 We take immense pride in our creations. The Atelier reserves the right to photograph garments in progress and in their finished state for our digital portfolio and social media channels.</p>
                    <p>6.2 We hold your privacy in high regard; images featuring the client themselves will only be shared with express verbal or written consent.</p>
                </div>

                <!-- 7. Privacy & Data -->
                <div style="margin-bottom: 45px;">
                    <h2 style="font-family: var(--font-serif); font-size: 1.85rem; color: #1a1a1a; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">7. Privacy & Confidentiality</h2>
                    <p style="margin-bottom: 15px;">7.1 Your personal narrative, including intimate measurements, contact details, and event specifics, is kept in the strictest confidence. </p>
                    <p>7.2 Data is utilized solely for the purpose of artisanal fulfillment and providing a personalized client experience. We do not engage in the sale or sharing of client information with external third parties.</p>
                </div>

                <!-- 8. Liability & Force Majeure -->
                <div style="margin-bottom: 45px;">
                    <h2 style="font-family: var(--font-serif); font-size: 1.85rem; color: #1a1a1a; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">8. Limitation of Liability</h2>
                    <p style="margin-bottom: 15px;">8.1 The Atelier strives for perfection but shall not be held liable for delays caused by circumstances beyond our control, including but not limited to global logistics disruptions, fabric manufacturer shortages, or acts of God (Force Majeure).</p>
                    <p>8.2 Our total financial liability is limited strictly to the total amount paid by the client for the specific garment under dispute.</p>
                </div>

                <!-- 9. Governing Law & Disputes -->
                <div style="margin-bottom: 45px;">
                    <h2 style="font-family: var(--font-serif); font-size: 1.85rem; color: #1a1a1a; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">9. Governing Law & Dispute Resolution</h2>
                    <p style="margin-bottom: 15px;">9.1 These terms and your relationship with the Atelier are governed by the laws of the Republic of the Philippines.</p>
                    <p>9.2 In the rare event of a disagreement, both parties agree to first seek an amicable resolution through private mediation before pursuing any legal action within the jurisdiction of Kalookan, Metro Manila.</p>
                </div>

                <p style="font-style: italic; color: #888; border-top: 1px solid #eee; pt-20px; margin-top: 50px; padding-top: 20px;">
                    Last updated: May 2026
                </p>
            </div>
        </div>
    </main>

    <x-chatbot />
    <x-footer></x-footer>

</body>
</html>

