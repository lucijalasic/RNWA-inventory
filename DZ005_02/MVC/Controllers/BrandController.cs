using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace MVC.Controllers
{
    public class BrandController : Controller
    {
        private readonly inventoryContext _context;

        public BrandController(inventoryContext context)
        {
            _context = context;

        }
        public IActionResult Index()
        {
            List<Brand> brands = _context.Brands.ToList();
            return View(brands);
        }

        public IActionResult Details(int Id)
        {
            Brand brand = _context.Brands.Where(p => p.BrandId == Id).FirstOrDefault();
            return View(brand);
        }

        [HttpGet]
        public IActionResult Edit(int Id)
        {
            Brand brand = _context.Brands.Where(p => p.BrandId == Id).FirstOrDefault();
            return View(brand);
        }

        [HttpPost]
        public IActionResult Edit(Brand brand)
        {
            _context.Attach(brand);
            _context.Entry(brand).State = EntityState.Modified;
            _context.SaveChanges();
            return RedirectToAction("index");
        }

        [HttpGet]
        public IActionResult Delete(int Id)
        {
            Brand brand = _context.Brands.Where(p => p.BrandId == Id).FirstOrDefault();
            return View(brand);
        }

        [HttpPost]
        public IActionResult Delete(Brand brand)
        {
            _context.Attach(brand);
            _context.Entry(brand).State = EntityState.Deleted;
            _context.SaveChanges();
            return RedirectToAction("index");
        }

        [HttpGet]
        public IActionResult Create()
        {
            Brand brand = new Brand();
            return View(brand);
        }

        [HttpPost]
        public IActionResult Create(Brand brand)
        {
            _context.Entry(brand).State = EntityState.Added;
            _context.SaveChanges();
            return RedirectToAction("index");
        }
    }
}
