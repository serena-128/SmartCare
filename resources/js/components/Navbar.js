// components/Navbar.js
import React from 'react';
import { Link } from 'react-router-dom';

const Navbar = () => {
  return (
    <nav className="bg-purple-100 shadow-md py-3 px-6 flex justify-between items-center">
      <div className="flex items-center space-x-3">
        <img src="/logo.png" alt="SmartCare Logo" className="h-12" />
        <h1 className="text-xl font-bold">Staff Dashboard</h1>
      </div>
      <div className="flex space-x-6 items-center text-sm font-medium">
        <Link to="/residents" className="hover:underline">👵 Residents</Link>
        <Link to="/medical-info" className="hover:underline">🩺 Residents Medical Information</Link>
        <Link to="/tasks" className="hover:underline">📅 Tasks & Appointments</Link>
        <Link to="/alerts" className="hover:underline">🎉 Emergency Alerts</Link>
        <Link to="/schedule" className="hover:underline">📅 My Schedule</Link>
        <span className="ml-4 font-semibold">👤 Mark Reilly ⌄</span>
      </div>
    </nav>
  );
};

export default Navbar;
