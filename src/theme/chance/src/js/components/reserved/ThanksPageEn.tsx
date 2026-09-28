import React from "react";
import { Alert, Button } from "react-bootstrap";

const ThanksPageEn: React.FC = () => {
	return (
		<div className="thanks-page text-center p-4">
			<h4 className="mb-4">Thank you for your reservation</h4>

			<Alert variant="info" className="mb-4">
				<Alert.Heading className="h5">
					Confirmation email has been sent
				</Alert.Heading>
				<p className="mb-0">
					A confirmation email with your reservation details has been sent to
					your registered email address.
					<br />
					If you don't receive the email, please contact us.
				</p>
			</Alert>

			<div className="d-grid gap-2">
				<Button variant="primary" href="/">
					Back to Top Page
				</Button>
				<Button variant="outline-primary" href="/cast">
					View Our Boys
				</Button>
			</div>
		</div>
	);
};

export default ThanksPageEn;
