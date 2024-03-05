import Image from 'next/image'
import Link from 'next/link'
import React, { useState } from 'react'

export default function Nav() {
    const links = [{
        "name": "About",
        "url": "#about"
    },
    {
        "name": "Projects",
        "url": "#projects"
    },
    {
        "name": "Contact",
        "url": "#contact"
    }]
    const [isOpen, setIsOpen] = useState(false)
    const handleToggleMenu = () => {
        setIsOpen(!isOpen)
    }
    return (
        <nav className="bg-white border-gray-200 dark:bg-gray-900">
            <div className="max-w-screen-xl flex flex-wrap md:flex-nowrap items-center justify-between mx-auto p-4">
                <Image src={"/images/simonlogo.png"} alt='simon portfolio' width={150} height={150} />
                <button
                    type="button"
                    className="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    onClick={handleToggleMenu}
                >
                    <span className="sr-only">Open main menu</span>
                    <svg
                        className="w-5 h-5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 17 14"
                    >
                        <path
                            stroke="currentColor"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth={2}
                            d="M1 1h15M1 7h15M1 13h15"
                        />
                    </svg>
                </button>
                <div className={`${isOpen ? "" : "hidden"} w-full md:block md:w-auto" id="navbar-default"`}>
                    <ul className="font-medium flex flex-col md:justify-end p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        {links.map((link, index) => {
                            return (
                                <li key={index}>
                                    <Link href={link.url} className="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                                    >{link.name}</Link>
                                </li>
                            )
                        })}

                    </ul>
                </div>
            </div>
        </nav>

    )
}
