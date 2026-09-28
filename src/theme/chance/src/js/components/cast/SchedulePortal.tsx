import Schedule from "@src/js/components/cast/Schedule";
import React from "react";
import { createPortal } from "react-dom";

const SchedulePortal: React.FC = () => {
	const elem = document.getElementById("cast_schedule");
	if (!elem) return null;

	const schedule = JSON.parse(elem.getAttribute("data-schedule") || "[]");
	const lang = elem.getAttribute("data-lang") || "ja";

	return createPortal(<Schedule schedule={schedule} lang={lang} />, elem);
};

export default SchedulePortal;
