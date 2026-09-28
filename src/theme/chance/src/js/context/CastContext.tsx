import React, { createContext, useState } from "react";

type CastData = {
	id: string;
	name: string;
	age: string;
};

type Prop = {
	cast?: CastData;
	setCast: (cast: CastData) => void;
};

const CastContext = createContext<Prop>({ cast: undefined, setCast: () => {} });

const CastProvider: React.FC<React.PropsWithChildren> = ({ children }) => {
	const [cast, setCast] = useState<CastData>({
		id: "",
		name: "",
		age: "",
	});

	return (
		<CastContext.Provider value={{ cast, setCast }}>
			{children}
		</CastContext.Provider>
	);
};
export { CastContext, CastProvider };
