import dotenv from "dotenv";

dotenv.config();

export const DB_URI = process.env.DB_URI as string;

export const CORS = process.env.CORS as string;

export const PORT = (process.env.PORT || 3000) as number;

export const MAPBOX_TOKEN = process.env.MAPBOX_TOKEN as string;

// SMTP
export const SMTP_HOST = process.env.SMTP_HOST as string;
export const SMTP_PORT = parseInt(process.env.SMTP_PORT as string);
export const SMTP_USER = process.env.SMTP_USER as string;
export const SMTP_PASSWORD = process.env.SMTP_PASSWORD as string;
export const SMTP_AUTH_METHOD = process.env.SMTP_AUTH_METHOD as string;