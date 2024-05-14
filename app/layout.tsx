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

  ReactGA.initialize("G-2BGZTZXRNN");
  ReactGA.send({ hitType: "pageview", page: "/", title: "Home page" });

  // Send a custom event
  ReactGA.event({
    category: "your category",
    action: "your action",
    label: "your label", // optional
    value: 99, // optional, must be a number
  });
  return (
    <html lang="en" className="dark">
      <body className={roboto.className}>{children}</body>
    </html>
  );
}
