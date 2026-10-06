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

export const courseDurationsEn = {
	PRIVATE_ROOM: [
		{ value: "30min-masturbation", label: "30 min (Masturbation viewing)" },
		{ value: "60min", label: "60 minutes" },
		{ value: "90min", label: "90 minutes" },
		{ value: "120min", label: "120 minutes" },
		{ value: "180min", label: "180 minutes" },
		{ value: "long", label: "Long" },
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
		{ value: "long", label: "Long" },
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

export const surveySchemaEn = z
	.object({
		"course-type": z.string().min(1, "Please select a course"),
		"course-duration": z.string().min(1, "Please select duration"),
		"other-course": z.string().optional(),
		"reservation-month": z.string().min(1, "Please select month"),
		"reservation-day": z.string().min(1, "Please select day"),
		"reservation-hour": z.string().min(1, "Please select hour"),
		"reservation-minute": z.string().min(1, "Please select minute"),
		"cast-name": z.string().min(1, "Please enter the boy's name"),
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
		// Store visit count
		"visit-count": z.string().min(1, "Please select visit count"),
		// Cast review
		"cast-review": z.string().optional(),
		// Review publication
		"publisibal-cast-review": z.string().optional(),
		"cast-impression": z.string().min(1, "Please select first impression"),
		// Cast photo gap
		"cast-photo-gap": z.string().min(1, "Please select photo gap"),
		// Cast language
		"cast-language": z.string().min(1, "Please select language skills"),
		// Cast service
		"cast-service": z.string().optional(),
		// Would you book this cast again?
		"cast-again": z.string().min(1, "Please select if you would book again"),
		// Reception response
		"reception-response": z.string().optional(),
		// Reception response concerns
		"reception-response-concern": z.string().optional(),
		// Website concerns
		"website-concern": z.string().optional(),
		// System concerns
		"system-concern": z.string().optional(),
		// Price concerns
		"price-concern": z.string().optional(),
		// Other opinions and requests
		"other-concern": z.string().optional(),
	})
	.refine(
		(data) => {
			if (
			data["email-confirm"] &&
			data["your-email"] !== data["email-confirm"]
		) {
				return false;
			}
			return true;
		},
		{
			message: "Email addresses do not match",
			path: ["email-confirm"],
		},
	);

export type SurveyFormDataEn = z.infer<typeof surveySchemaEn>;
