import React from "react";
import { Alert, Button } from "react-bootstrap";

const ThanksPageEn: React.FC = () => {
	return (
		<div className="thanks-page text-center p-4">
			<h4 className="mb-4">Thank you for your survey response</h4>

			<Alert variant="info" className="mb-4">
				<Alert.Heading className="h5">
					Your survey has been submitted
				</Alert.Heading>
				<p className="mb-0">
					The feedback you provided will be used to improve our service.
					<br />
					We look forward to serving you again.
				</p>
			</Alert>

			<div className="d-grid gap-2">
				<Button variant="primary" href="/">
					Go to Top Page
				</Button>
				<Button variant="outline-primary" href="/en/cast">
					View Our Boys
				</Button>
			</div>
		</div>
	);
};

export default ThanksPageEn;
