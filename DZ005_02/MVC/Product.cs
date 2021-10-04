using System;
using System.Collections.Generic;

#nullable disable

namespace MVC
{
    public partial class Product
    {
        public int ProductId { get; set; }
        public string ProductName { get; set; }
        public int? BrandId { get; set; }
        public string Quantity { get; set; }
        public string Rate { get; set; }
        public int? Active { get; set; }

        public virtual Brand Brand { get; set; }
    }
}
