<?php
/* Template Name: 10_よくある質問(en) */
?>
<?php get_header( 'en' ); ?>
<?php
$faq_array = array(
	array(
		'key'      => 'whereIsShop',
		'question' => 'Where is the shop located?',
		'answer'   => 'We operate as a non-storefront business, so reservations are required. <br>We have private rooms available within a 5-minute walk from Shinjuku-Gyoemmae Station.<br>As the number of rooms is limited, we recommend making a reservation as early as possible.<br>After your reservation, we will inform you of the designated location. Please contact our shop via email or LINE from that location at your reserved time.<br>Your selected staff member will then guide you to the private room.',
	),
	array(
		'key'      => 'howLongForOutcall',
		'question' => 'What is the minimum duration for outcall service?',
		'answer'   => 'Outcall service is available from 60 minutes.<br>If your destination is more than one hour away by public transportation, an additional long-distance fee will be charged on top of the course fee and transportation costs.<br>Please check the pricing page or contact our staff for details about the long-distance fee.',
	),
	array(
		'key'      => 'hotelCheckIn',
		'question' => 'What if my hotel check-in is close to the reservation time?',
		'answer'   => 'For hotel outcalls, our staff will be dispatched after you notify us of your check-in.<br>If the staff has a prior reservation, your course time may be shortened, so we recommend booking with plenty of time.',
	),
	array(
		'key'      => 'singleRoomCheck',
		'question' => 'Is it okay if I reserved a single room for a hotel outcall?',
		'answer'   => 'The safest option is to reserve a double or twin room.<br>For hotels we have previously visited, we can usually send staff, but if entry is not possible, you will still be charged for the course and transportation.',
	),
	array(
		'key'      => 'roomConfirmation',
		'question' => 'Is room confirmation absolutely necessary?',
		'answer'   => 'We are sorry, but room confirmation is always required.',
	),
	array(
		'key'      => 'loveHotelUsage',
		'question' => 'Can I use a love hotel?',
		'answer'   => 'Yes, you can.',
	),
	array(
		'key'      => 'hotelOutsideMeeting',
		'question' => 'Can I meet outside the hotel?',
		'answer'   => 'Basically, yes, but we will confirm your room before dispatching staff.',
	),
	array(
		'key'      => 'courseChange',
		'question' => 'Can I change the course after it starts?',
		'answer'   => 'You can change the course within the first 5 minutes.<br>After 5 minutes, the regular fee will apply, so please be careful.',
	),
	array(
		'key'      => 'cancelationPolicy',
		'question' => 'Can I cancel my reservation?',
		'answer'   => 'If you cancel within 5 minutes of the course start or after meeting the staff, a 5,000 yen cancellation fee will be charged.<br>If you cancel without notice, you will be charged 100% of the fee.',
	),
	array(
		'key'      => 'paymentLocation',
		'question' => 'Where do I pay?',
		'answer'   => 'You will only meet the staff you reserved, so please pay directly to the staff member.',
	),
	array(
		'key'      => 'creditCardUsage',
		'question' => 'Can I use a credit card?',
		'answer'   => 'All the credit cards issued outside of Japan are not acceptable. Please be ready to pay with cash in advance.',
	),
	array(
		'key'      => 'privacy',
		'question' => 'Will anyone know I used your service?',
		'answer'   => 'We strictly manage all customer privacy information so you can use our service with peace of mind.',
	),
	array(
		'key'      => 'playContent',
		'question' => 'Can you tell me more about the play content?',
		'answer'   => 'All staff can provide kissing, oral contact, and body contact.<br>For back play and other options, please check each staff member\'s personal page.',
	),
	array(
		'key'      => 'courseStartTime',
		'question' => 'When does the course time start?',
		'answer'   => 'The course starts when you meet the staff.<br>If your outcall location is more than a 10-minute walk from the nearest station, an extra taxi fee will be charged.<br>If you pick up the staff at the station, the course time starts when you meet at the station.',
	),
)
?>
<section class="faq pdb90 sppdb20" id="qanda">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">Q&amp;A</span><br>
		<h2>Frequently Asked Questions</h2>
	</div>
	<p class="fs-5 text-center">Here are some frequently asked questions from our customers. Please refer to them when using our service.</p>

	<div class="accordion container box" id="faqAccordion">
		<?php foreach ( $faq_array as $faq ) : ?>
			<div class="accordion-item qa_box">
				<h3 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $faq['key']; ?>" aria-expanded="false" aria-controls="<?php echo $faq['key']; ?>">
						<?php echo $faq['question']; ?>
					</button>
				</h3>
				<div id="<?php echo $faq['key']; ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
					<div class="accordion-body">
						<?php echo $faq['answer']; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [
			<?php
			foreach ( $faq_array as $faq ) :
				?>
				{
					"@type": "Question",
					"name": "<?php echo $faq['question']; ?>",
					"acceptedAnswer": {
						"@type": "Answer",
						"text": "<?php echo $faq['answer']; ?>"
					}
				}
				<?php
				if ( end( $faq_array ) !== $faq ) :
					?>
					, <?php endif; ?>
	<?php endforeach; ?>
	]
	}
	</script>
	<?php get_footer( 'en' ); ?>
