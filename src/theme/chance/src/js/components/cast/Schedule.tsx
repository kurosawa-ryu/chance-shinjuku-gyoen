import ScheduleCardBody from "@src/js/components/cast/ScheduleCardBody";
import ChevronLeftIcon from "@src/js/components/common/ChevronLeftIcon";
import ChevronRightIcon from "@src/js/components/common/ChevronRightIcon";
import useEmblaCarousel from "embla-carousel-react";
import React, { useCallback, useEffect, useState } from "react";

type Prop = {
	schedule: Schedule[];
	lang: string;
};

type Schedule = {
	date: string;
	time: {
		start: string;
		end: string;
	};
	ladywork_txt: string;
};

const Schedule: React.FC<Prop> = ({ schedule, lang = "ja" }) => {
	const [isMobile, setIsMobile] = useState<boolean>(false);

	useEffect(() => {
		const checkIfMobile = () => {
			setIsMobile(window.innerWidth < 768);
		};

		checkIfMobile();
		window.addEventListener("resize", checkIfMobile);

		return () => {
			window.removeEventListener("resize", checkIfMobile);
		};
	}, []);

	const [emblaRef, emblaApi] = useEmblaCarousel({
		dragFree: true,
		containScroll: "trimSnaps",
		loop: false,
		slidesToScroll: isMobile ? 5 : 7,
	});

	const [prevBtnEnabled, setPrevBtnEnabled] = useState(false);
	const [nextBtnEnabled, setNextBtnEnabled] = useState(false);

	const scrollPrev = useCallback(() => emblaApi?.scrollPrev(), [emblaApi]);
	const scrollNext = useCallback(() => emblaApi?.scrollNext(), [emblaApi]);

	const onSelect = useCallback(() => {
		if (!emblaApi) return;
		setPrevBtnEnabled(emblaApi.canScrollPrev());
		setNextBtnEnabled(emblaApi.canScrollNext());
	}, [emblaApi]);

	useEffect(() => {
		if (!emblaApi) return;

		emblaApi.reInit({
			dragFree: true,
			containScroll: "trimSnaps",
			loop: false,
			slidesToScroll: isMobile ? 5 : 7,
		});

		onSelect();
		emblaApi.on("select", onSelect);
		emblaApi.on("reInit", onSelect);

		return () => {
			emblaApi.off("select", onSelect);
			emblaApi.off("reInit", onSelect);
		};
	}, [emblaApi, onSelect, isMobile]);

	return (
		<div className="cast__schedule-slider">
			<button
				className={`cast__schedule-slider__button cast__schedule-slider__button--prev ${!prevBtnEnabled ? "cast__schedule-slider__button--disabled" : ""}`}
				onClick={scrollPrev}
				disabled={!prevBtnEnabled}
				aria-label={lang === "ja" ? "前のスケジュールへ" : "Previous schedule"}
				type="button"
			>
				<span className="cast__schedule-slider__button-icon">
					<ChevronLeftIcon />
				</span>
			</button>
			<div className="cast__schedule-slider__viewport" ref={emblaRef}>
				<div className="cast__schedule-slider__container">
					{schedule.map((item) => (
						<div
							className="cast__schedule-slider__slide"
							key={`${item.date}_${item.time.start}_${item.time.end}`}
						>
							<div className="cast__schedule-slider__box">
								<div className="cast__schedule-slider__head">{item.date}</div>
								<div className="cast__schedule-slider__body matchbox">
									<ScheduleCardBody
										start={item.time.start}
										end={item.time.end}
										ladywork={item.ladywork_txt}
										lang={lang}
									/>
								</div>
							</div>
						</div>
					))}
				</div>
			</div>
			<button
				className={`cast__schedule-slider__button cast__schedule-slider__button--next ${!nextBtnEnabled ? "cast__schedule-slider__button--disabled" : ""}`}
				onClick={scrollNext}
				disabled={!nextBtnEnabled}
				aria-label={lang === "ja" ? "次のスケジュールへ" : "Next schedule"}
				type="button"
			>
				<span className="cast__schedule-slider__button-icon">
					<ChevronRightIcon />
				</span>
			</button>
		</div>
	);
};
export default Schedule;
