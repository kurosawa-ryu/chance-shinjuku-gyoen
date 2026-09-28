import React from "react";

type Prop = {
	start: string;
	end: string;
	ladywork: string;
	lang: string;
};

const ScheduleCardBody: React.FC<Prop> = ({
	start,
	end,
	ladywork,
	lang = "ja",
}) => {
	if (lang === "ja") {
		if (ladywork === "休み") {
			return "休み";
		}
		if (ladywork === "予約満了") {
			return <span className="red">ご予約満了</span>;
		}
		if (ladywork === "名古屋勤務") {
			return <span className="sky">名古屋勤務</span>;
		}
		if (ladywork === "大阪勤務") {
			return <span className="green">大阪勤務</span>;
		}
		if (ladywork === "東京勤務") {
			return <span className="red">東京勤務</span>;
		}
		if (ladywork === "難波勤務") {
			return <span className="purple">難波勤務</span>;
		}
		if (start === end) {
			return "未定";
		}
		if (ladywork === "") {
			return `${start}~${end}`;
		}
	} else {
		if (ladywork === "Rest") {
			return "Rest";
		}
		if (ladywork === "Full") {
			return <span className="red">Full</span>;
		}
		if (ladywork === "Nagoya") {
			return <span className="sky">Nagoya</span>;
		}
		if (ladywork === "Osaka") {
			return <span className="green">Osaka</span>;
		}
		if (ladywork === "Tokyo") {
			return <span className="red">Tokyo</span>;
		}
		if (ladywork === "Namba") {
			return <span className="purple">Namba</span>;
		}
		if (start === end) {
			return "Not yet";
		}
		if (ladywork === "") {
			return `${start}~${end}`;
		}
	}

	return (
		<>
			{`${start}~${end}`}
			<br />
			{ladywork}
		</>
	);
};

export default ScheduleCardBody;
