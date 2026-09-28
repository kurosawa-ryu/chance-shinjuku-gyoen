import { ReservationFormData } from "@src/js/schema/reservationSchema";
import {
	ReservationFormDataEn,
	courseDurationsEn,
	courseTypesEn,
} from "@src/js/schema/reservationSchemaEn";
import React from "react";
import { Alert, Table } from "react-bootstrap";
import { UseFormWatch } from "react-hook-form";

type Props = {
	watch: UseFormWatch<ReservationFormData>;
};

const StepConfirmationEn: React.FC<Props> = ({ watch }) => {
	const formData = watch();
	const is3pOrSwap = [
		"3p-60min",
		"3p-90min",
		"3p-120min",
		"swap-90min",
		"swap-120min",
	].includes(formData["course-duration"]);
	const isLongCourse = [
		"long-21-9",
		"long-22-9",
		"long-23-9",
		"long-24-9",
	].includes(formData["course-duration"]);
	const isDateOnly = formData["course-type"] === courseTypesEn.DATE_ONLY;
	const isSwap = ["swap-90min", "swap-120min"].includes(
		formData["course-duration"],
	);
	const is3p = ["3p-60min", "3p-90min", "3p-120min"].includes(
		formData["course-duration"],
	);
	const hasDateCombined =
		formData["date-combined"] && formData["date-combined"] !== "none";

	return (
		<>
			<div className="confirmation-section mb-4">
				<h5 className="mb-3">Reservation Details</h5>
				<Table borderless size="sm">
					<tbody>
						<tr>
							<th>Course</th>
							<td>{formData["course-type"]}</td>
						</tr>
						{formData["course-type"] !== courseTypesEn.OTHER && (
							<tr>
								<th>Course Duration</th>
								<td>
									{Object.values(courseDurationsEn)
										.flat()
										.find((d) => d.value === formData["course-duration"])
										?.label || formData["course-duration"]}
								</td>
							</tr>
						)}
						{hasDateCombined && (
							<tr>
								<th>Date Service Combined</th>
								<td>{formData["date-combined"]}</td>
							</tr>
						)}
						{formData["course-type"] === courseTypesEn.OTHER && (
							<tr>
								<th>Other Course</th>
								<td>{formData["other-course"]}</td>
							</tr>
						)}
						<tr>
							<th>Reservation Date & Time</th>
							<td>
								{formData["reservation-month"]}/{formData["reservation-day"]}{" "}
								{formData["reservation-hour"]}:{formData["reservation-minute"]}
							</td>
						</tr>
						<tr>
							<th>Requested Boy</th>
							<td>{formData["cast-name"]}</td>
						</tr>
						{formData["course-type"] === courseTypesEn.DELIVERY && (
							<tr>
								<th>Delivery Location</th>
								<td>{formData["delivery-location"]}</td>
							</tr>
						)}
						<tr>
							<th>Anal Play</th>
							<td>
								{formData["cast-anal-play"] === "none" && "None"}
								{formData["cast-anal-play"] === "boy-receiving" &&
									"Boy receiving (Customer inserting)"}
								{formData["cast-anal-play"] === "boy-inserting" &&
									"Boy inserting (To customer)"}
								{formData["cast-anal-play"] === "both" && "Both"}
							</td>
						</tr>
						{is3pOrSwap && (
							<tr>
								<th>Second Boy's Anal Play</th>
								<td>
									{formData["cast2-anal-play"] === "none" && "None"}
									{formData["cast2-anal-play"] === "boy-receiving" &&
										"Boy receiving (Customer inserting)"}
									{formData["cast2-anal-play"] === "boy-inserting" &&
										"Boy inserting (To customer)"}
									{formData["cast2-anal-play"] === "both" && "Both"}
								</td>
							</tr>
						)}
						{is3p && (
							<tr>
								<th>Boy-to-Boy Interaction (+4,000 yen)</th>
								<td>{formData["boy-interaction"] === "yes" ? "Yes" : "No"}</td>
							</tr>
						)}
						<tr>
							<th>Discount Ticket</th>
							<td>
								{formData["has-discount-ticket"] === "yes" ? "Yes" : "No"}
							</td>
						</tr>
						{formData["play-requests"] && (
							<tr>
								<th>Play Requests</th>
								<td>{formData["play-requests"]}</td>
							</tr>
						)}
						{(isLongCourse || isDateOnly) && (
							<tr>
								<th>Meal During Course</th>
								<td>
									{formData["has-meal-during-course"] === "yes" ? "Yes" : "No"}
								</td>
							</tr>
						)}
					</tbody>
				</Table>
			</div>

			<div className="confirmation-section mb-4">
				<h5 className="mb-3">Customer Information</h5>
				<Table borderless size="sm">
					<tbody>
						<tr>
							<th>Name</th>
							<td>{formData["your-name"]}</td>
						</tr>
						<tr>
							<th>Email Address</th>
							<td>{formData["your-email"]}</td>
						</tr>
						<tr>
							<th>Phone Number</th>
							<td>{formData["your-tel"]}</td>
						</tr>
						<tr>
							<th>Previous appointment with {formData["cast-name"]}</th>
							<td>{formData["has-previous-cast"] === "yes" ? "Yes" : "No"}</td>
						</tr>
						<tr>
							<th>Previous visit to our store</th>
							<td>{formData["has-previous-visit"] === "yes" ? "Yes" : "No"}</td>
						</tr>
						{is3pOrSwap && (
							<tr>
								<th>Previous appointment with {formData["cast2-name"]}</th>
								<td>
									{formData["has-previous-cast2"] === "yes" ? "Yes" : "No"}
								</td>
							</tr>
						)}
					</tbody>
				</Table>
			</div>

			<Alert variant="info" className="mb-4">
				<Alert.Heading>Please Confirm</Alert.Heading>
				<p className="mb-0">
					If the reservation details are correct, please click the "Confirm
					Reservation" button. If you need to make changes, you can go back to
					the previous screen using the "Back" button.
				</p>
			</Alert>
		</>
	);
};

export default StepConfirmationEn;
