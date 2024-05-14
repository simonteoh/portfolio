import type { Metadata } from "next";
import "./globals.css";
import { Roboto } from 'next/font/google'
import ReactGA from "react-ga4";

const roboto = Roboto({
  weight: ['400', '900'],
  subsets: ['latin'],
  display: 'swap',
})
export const metadata: Metadata = {
  title: "Simon's Porfolio",
  description: "portfolio using Nextjs",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {

  ReactGA.initialize("G-45J6BQ9JRD");

  return (
    <html lang="en" className="dark">
      <body className={roboto.className}>{children}</body>
    </html>
  );
}
