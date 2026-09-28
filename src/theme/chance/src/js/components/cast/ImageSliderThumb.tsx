import React from "react";

type PropType = {
	selected: boolean;
	index: number;
	onClick: () => void;
	src: string;
};

export const Thumb: React.FC<PropType> = ({
	selected,
	index,
	onClick,
	src,
}) => {
	return (
		<div
			className={`image-slider__thumbs__slide${selected ? " image-slider__thumbs__slide--selected" : ""}`}
		>
			<button
				onClick={onClick}
				type="button"
				className="image-slider__thumbs__slide__number"
			>
				<img
					src={src}
					className="image-slider__thumbs__slide__img"
					alt={`スライド ${index + 1}`}
				/>
			</button>
		</div>
	);
};
