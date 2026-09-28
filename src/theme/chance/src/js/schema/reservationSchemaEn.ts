import { z } from "zod";

export const courseTypesEn = {
	PRIVATE_ROOM: "Private Room",
	DELIVERY: "Outcall",
	DATE_ONLY: "Date Only",
	OTHER: "Other",
} as const;

export type DurationEn = {
	value: string;
	label: string;
};

// Date service combined options
export const dateCombinedOptionsEn = [
	{ value: "60min", label: "60 minutes" },
	{ value: "120min", label: "120 minutes" },
];

export const courseDurationsEn = {
	PRIVATE_ROOM: [
		{ value: "30min-masturbation", label: "30 min (Masturbation viewing)" },
		{ value: "60min", label: "60 minutes" },
		{ value: "90min", label: "90 minutes" },
		{ value: "120min", label: "120 minutes" },
		{ value: "180min", label: "180 minutes" },
		{ value: "long-21-9", label: "Long 21:00~9:00" },
		{ value: "long-22-9", label: "Long 22:00~9:00" },
		{ value: "long-23-9", label: "Long 23:00~9:00" },
		{ value: "long-24-9", label: "Long 24:00~9:00" },
		{ value: "3p-60min", label: "3P 60 minutes" },
		{ value: "3p-90min", label: "3P 90 minutes" },
		{ value: "3p-120min", label: "3P 120 minutes" },
		{ value: "swap-90min", label: "Swap 90 minutes" },
		{ value: "swap-120min", label: "Swap 120 minutes" },
	],
	DELIVERY: [
		{ value: "60min", label: "60 minutes" },
		{ value: "90min", label: "90 minutes" },
		{ value: "120min", label: "120 minutes" },
		{ value: "180min", label: "180 minutes" },
		{ value: "long-21-9", label: "Long 21:00~9:00" },
		{ value: "long-22-9", label: "Long 22:00~9:00" },
		{ value: "long-23-9", label: "Long 23:00~9:00" },
		{ value: "long-24-9", label: "Long 24:00~9:00" },
		{ value: "3p-60min", label: "3P 60 minutes" },
		{ value: "3p-90min", label: "3P 90 minutes" },
		{ value: "3p-120min", label: "3P 120 minutes" },
		{ value: "swap-90min", label: "Swap 90 minutes" },
		{ value: "swap-120min", label: "Swap 120 minutes" },
	],
	DATE_ONLY: [
		{ value: "60min", label: "60 minutes" },
		{ value: "120min", label: "120 minutes" },
	],
} as const;

export const reservationSchemaEn = z
	.object({
		"course-type": z.string().min(1, "Please select a course"),
		"course-duration": z.string().min(1, "Please select duration"),
		"other-course": z.string().optional(),
		"date-combined": z.string().optional(),
		"reservation-month": z.string().min(1, "Please select month"),
		"reservation-day": z.string().min(1, "Please select day"),
		"reservation-hour": z.string().min(1, "Please select hour"),
		"reservation-minute": z.string().min(1, "Please select minute"),
		"cast-name": z.string().min(1, "Please enter the boy's name"),
		"cast2-name": z.string().optional(),
		"delivery-location": z.string().optional(),
		"cast-anal-play": z.string().optional(),
		"cast2-anal-play": z.string().optional(),
		"has-discount-ticket": z
			.string()
			.min(1, "Please select discount ticket availability"),
		"play-requests": z.string().optional(),
		"your-name": z.string().min(1, "Please enter your name"),
		"your-email": z
			.string()
			.email("Please enter a valid email address")
			.min(1, "Please enter your email address"),
		"email-confirm": z
			.string()
			.email("Please enter a valid email address")
			.or(z.literal(""))
			.optional(),
		"your-tel": z
			.string()
			.regex(/^[0-9-]+$/, "Phone number can only contain numbers and hyphens")
			.or(z.literal(""))
			.optional(),
		"has-previous-cast": z
			.string()
			.min(1, "Please select previous appointment with this boy"),
		"has-previous-cast2": z.string().optional(),
		"has-previous-visit": z
			.string()
			.min(1, "Please select previous visit to our store"),
		"has-meal-during-course": z.string().optional(),
		"boy-interaction": z.string().optional(),
	})
	.refine(
		(data) => {
			if (data["course-type"] === courseTypesEn.DELIVERY) {
				if (!data["delivery-location"]) {
					return false;
				}
			}
			return true;
		},
		{
			message: "Please enter delivery location",
			path: ["deliveryLocation"],
		},
	)
	.refine(
		(data) => {
			if (data["your-email"] && data["your-email"] !== data["email-confirm"]) {
				return false;
			}
			return true;
		},
		{
			message: "Email addresses do not match",
			path: ["email-confirm"],
		},
	)
	.refine(
		(data) => {
			const is3pOrSwap = [
				"3p-60min",
				"3p-90min",
				"3p-120min",
				"swap-90min",
				"swap-120min",
			].includes(data["course-duration"]);
			const isDateOnly = data["course-type"] === courseTypesEn.DATE_ONLY;
			if (is3pOrSwap && !isDateOnly) {
				return !!data["cast2-name"] && data["cast2-name"].trim().length > 0;
			}
			return true;
		},
		{
			message: "Please enter the second boy's name",
			path: ["cast2-name"],
		},
	)
	.refine(
		(data) => {
			const is3pOrSwap = [
				"3p-60min",
				"3p-90min",
				"3p-120min",
				"swap-90min",
				"swap-120min",
			].includes(data["course-duration"]);
			const isDateOnly = data["course-type"] === courseTypesEn.DATE_ONLY;
			if (is3pOrSwap && !isDateOnly) {
				return (
					!!data["cast2-anal-play"] && data["cast2-anal-play"].trim().length > 0
				);
			}
			return true;
		},
		{
			message: "Please select the second boy's anal play",
			path: ["cast2-anal-play"],
		},
	)
	.refine(
		(data) => {
			const isLongCourse = [
				"long-21-9",
				"long-22-9",
				"long-23-9",
				"long-24-9",
			].includes(data["course-duration"]);
			const isDateOnly = data["course-type"] === courseTypesEn.DATE_ONLY;
			if (isLongCourse || isDateOnly) {
				return (
					!!data["has-meal-during-course"] &&
					data["has-meal-during-course"].trim().length > 0
				);
			}
			return true;
		},
		{
			message: "Please select meal availability during course",
			path: ["has-meal-during-course"],
		},
	)
	.refine(
		(data) => {
			const is3pOrSwap = [
				"3p-60min",
				"3p-90min",
				"3p-120min",
				"swap-90min",
				"swap-120min",
			].includes(data["course-duration"]);
			const isDateOnly = data["course-type"] === courseTypesEn.DATE_ONLY;
			if (is3pOrSwap && !isDateOnly) {
				return (
					!!data["has-previous-cast2"] &&
					data["has-previous-cast2"].trim().length > 0
				);
			}
			return true;
		},
		{
			message: "Please select previous appointment with the second boy",
			path: ["has-previous-cast2"],
		},
	)
	.refine(
		(data) => {
			const is3p = ["3p-60min", "3p-90min", "3p-120min"].includes(
				data["course-duration"],
			);
			if (is3p) {
				return (
					!!data["boy-interaction"] && data["boy-interaction"].trim().length > 0
				);
			}
			return true;
		},
		{
			message: "Please select boy-to-boy interaction preference",
			path: ["boy-interaction"],
		},
	);

export type ReservationFormDataEn = z.infer<typeof reservationSchemaEn>;
