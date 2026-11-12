# FORGE PC
### PC Retail, Configuration & Technical Services Platform

**FORGE PC** is a web-based platform designed to bring PC retail, custom computer configuration, hardware inventory, technical services, and business operations into one integrated system.

The platform aims to provide customers with a complete PC shopping experience, from browsing individual hardware components and configuring custom builds to purchasing products and requesting technical services.

On the business side, FORGE PC provides dedicated workspaces for administrators, inventory personnel, store managers, and technicians to manage daily operations through a centralized platform.

The system follows a modular development approach, allowing individual business domains to be developed, tested, and integrated independently without sacrificing overall system consistency.

> **Development Approach:** Modular Development  
> **Architecture:** Modular Monolith  
> **Project Stage:** Planning & MVP Development  
> **Release Target:** FORGE PC 1.0

---

## 01. Project Overview

FORGE PC is organized around eight functional systems supported by a shared application foundation.

Rather than developing the platform as one large application with tightly coupled functionality, each business domain has its own responsibilities, data ownership boundaries, and integration contracts.

### System Architecture at a Glance

| Module | Primary Responsibility |
|---|---|
| MVP 0 — Core Foundation | Architecture, authentication, and shared infrastructure |
| MVP 1 — Product Catalog | Hardware listings and specifications |
| MVP 2 — Inventory Management | Stock, suppliers, and inventory movements |
| MVP 3 — PC Builder | Custom PC configurations and compatibility validation |
| MVP 4 — PC Recommendations | Budget and usage-based build recommendations |
| MVP 5 — E-commerce & Orders | Purchasing, payments, and order fulfillment |
| MVP 6 — Repair & Services | Troubleshooting, pre-assessment, and appointments |
| MVP 7 — Technician Workspace | Diagnostics, repair assignments, and service tracking |
| MVP 8 — Business Intelligence | Business analytics and operational reporting |

These are logical modules within one integrated platform, not necessarily separate applications or databases.

The initial implementation will use a modular monolith, with a centralized Laravel backend and independently organized React interfaces.

---

## 02. Technology Stack

The following technologies define the proposed application foundation.

| Component | Technology |
|---|---|
| Backend | PHP / Laravel |
| Frontend | React.js |
| Build Tool | Vite |
| Styling | Tailwind CSS |
| Database | MySQL / MariaDB |
| API Architecture | REST API |
| Authentication | Laravel-based authentication |
| Data Visualization | Chart.js / React charting libraries |
| Version Control | Git / GitHub |

*The stack represents the intended architecture and may evolve as implementation decisions are finalized.*

---

## 03. User Roles & Access Control

FORGE PC uses role-based access control (RBAC) to ensure that each user can access only the functionality relevant to their responsibilities.

| Role | Responsibilities |
|---|---|
| Customer | Browse products, configure PCs, place orders, and request services |
| Administrator | Manage users, products, configurations, and overall system operations |
| Inventory Staff | Handle stock receiving, adjustments, suppliers, and inventory movements |
| Technician | Manage assigned repairs, diagnostics, and technical service records |
| Store Manager | Monitor business operations, orders, inventory, and performance |

Authorization will be enforced on the backend rather than relying exclusively on frontend route restrictions.

---

## 04. System Modules & MVP Specifications

### MVP 0 — Core Foundation & Infrastructure

<sub>FOUNDATIONAL MODULE · REQUIRED BY ALL SYSTEMS</sub>

Establishes the shared infrastructure that all other modules will depend on.

**Core responsibilities:**
- Laravel and React project configuration.
- Database schema and relationship management.
- Authentication and session management.
- Role-based access control.
- Shared layouts and reusable UI components.
- API response standards and validation.
- Notification infrastructure.
- Audit logging.
- Centralized error handling.

**Initial database entities:**

`users`, `roles`, `permissions`, `role_permissions`, `user_roles`, `notifications`, `audit_logs`.

**Deliverable:** A functioning application where users can authenticate, access their authorized workspaces, and communicate with the backend.

### MVP 1 — Product Catalog & Hardware Database

<sub>COMMERCE FOUNDATION</sub>

Provides the centralized hardware catalog used throughout the platform.

**Customer functionality:**
- Browse hardware products.
- Search and filter components.
- View product details and specifications.
- Compare hardware components.
- Check product pricing and availability.

**Administrative functionality:**
- Create, update, and archive products.
- Manage product categories and brands.
- Upload product images.
- Define structured hardware specifications.
- Manage product pricing and publication status.

**Structured hardware specifications:**

| Component | Important Specifications |
|---|---|
| CPU | Socket, cores, threads, TDP, memory support |
| Motherboard | Socket, chipset, form factor, RAM type |
| GPU | Dimensions, power consumption, connectors |
| RAM | DDR generation, capacity, speed |
| PSU | Wattage, efficiency, connectors |
| Casing | Form factor support, GPU clearance |
| CPU Cooler | Socket support, height, radiator dimensions |

**Suggested database entities:**

`categories`, `brands`, `products`, `product_images`, `product_specifications`, `product_prices`.

**Deliverable:** A functional hardware catalog with structured product specifications.

### MVP 2 — Inventory & Supplier Management

<sub>BUSINESS OPERATIONS</sub>

Handles the physical inventory of products available for sale and internal business operations.

**Core functionality:**
- Receive incoming inventory.
- Manage supplier information.
- Record purchase orders.
- Track stock quantities.
- Monitor incoming and outgoing stock.
- Record damaged and defective products.
- Configure low-stock thresholds.
- Maintain inventory movement history.
- Perform stock adjustments.

**Suggested database entities:**

`suppliers`, `purchase_orders`, `purchase_order_items`, `inventory`, `stock_movements`, `stock_adjustments`.

**Important architectural rule:**

Product catalog and inventory are separate concerns.

A product may exist in the catalog even when its available stock is zero. The catalog defines what the store sells, while inventory tracks the actual physical quantities.

**Deliverable:** A functional inventory management system integrated with the product catalog.

### MVP 3 — Custom PC Builder & Compatibility Engine

<sub>CORE DIFFERENTIATING FEATURE</sub>

Allows customers to configure their own computers by selecting individual hardware components while receiving compatibility feedback.

**Customer functionality:**
- Select PC components.
- Add, replace, or remove components.
- View the complete configuration.
- Calculate total build cost.
- Receive compatibility feedback.
- Save and share configurations.
- Submit configurations for store verification.

**Compatibility validation:**

| Validation | Example |
|---|---|
| CPU / Motherboard | Socket compatibility |
| Motherboard / RAM | DDR generation and supported memory |
| GPU / Casing | Physical clearance |
| PSU / Components | Power capacity and connectors |
| Motherboard / Casing | Form factor |
| CPU / Cooler | Socket mounting compatibility |
| Cooler / Casing | Height and radiator clearance |
| CPU / Motherboard | BIOS support |

**Compatibility outcomes:**

- **Compatible** — All known required constraints pass.
- **Warning** — Additional verification or consideration is required.
- **Incompatible** — At least one required technical constraint is violated.

**Suggested database entities:**

`pc_builds`, `pc_build_items`, `compatibility_rules`, `compatibility_results`.

Compatibility rules should be traceable and versioned to accommodate hardware revisions and firmware updates.

**Deliverable:** A working PC configurator capable of validating configurations against structured hardware specifications.

### MVP 4 — Intelligent PC Recommendation System

<sub>PERSONALIZED CUSTOMER EXPERIENCE</sub>

Helps customers identify suitable computer configurations based on their budget, intended usage, and performance requirements.

**Customer functionality:**
- Select intended PC usage.
- Specify available budget.
- Choose preferred performance level.
- Identify software and applications.
- Receive recommended configurations.
- Compare suggested builds.
- Customize recommended configurations.

**Recommendation profiles:**

| Intended Usage | Primary Considerations |
|---|---|
| Programming | CPU, RAM, SSD |
| Gaming | GPU, CPU, RAM |
| Video Editing | CPU, GPU, RAM, Storage |
| 3D Modeling | GPU, CPU, RAM |
| Graphic Design | RAM, CPU, Display |
| Office Work | CPU, SSD, Reliability |
| Machine Learning | GPU/VRAM, RAM, Storage |

**Recommendation categories:**
- Budget Configuration
- Balanced Configuration
- Performance Configuration

**Suggested database entities:**

`usage_profiles`, `application_requirements`, `recommendation_sessions`, `recommendation_results`.

**Implementation direction:**

Start with rule-based recommendations using structured hardware data and benchmark information.

Machine learning and AI-generated explanations can be introduced in later iterations. Regardless of the recommendation method, the compatibility engine remains responsible for validating the actual hardware combinations.

**Deliverable:** A guided PC recommendation system integrated with the PC Builder.

### MVP 5 — E-commerce, Checkout & Order Management

<sub>TRANSACTION PROCESSING</sub>

Handles the purchasing process, from product selection to payment verification and order fulfillment.

**Customer functionality:**
- Add hardware components to cart.
- Purchase prebuilt computers.
- Purchase custom PC configurations.
- Checkout and submit orders.
- Select delivery or store pickup.
- Apply discount codes.
- Choose available payment methods.
- View order history.
- Track order status.
- Request cancellations based on store policy.

**Administrative functionality:**
- Review customer orders.
- Verify payments.
- Process refunds.
- Manage order statuses.
- Handle cancellations.
- Manage fulfillment.
- Generate invoices and receipts.

**Proposed order lifecycle:**

`Pending Payment → Payment Verification → Processing → Assembly / Packing → Ready for Pickup / Shipped → Completed`

**Suggested database entities:**

`carts`, `cart_items`, `orders`, `order_items`, `payments`, `payment_transactions`, `shipments`, `discounts`, `refunds`.

**Important integration:**

Inventory reservations and stock deductions must be handled through the inventory module. Custom PC orders must also undergo compatibility and availability validation before fulfillment.

Payment status must be verified through trusted backend or payment-provider confirmation, not frontend submission alone.

**Deliverable:** A functioning e-commerce system supporting individual hardware purchases, prebuilt PCs, and custom configurations.

### MVP 6 — Troubleshooting, Repair & Appointment Booking

<sub>TECHNICAL SERVICE INTAKE</sub>

Provides customers with an online process for requesting computer troubleshooting, maintenance, and repair services.

**Customer functionality:**
- Browse available technical services.
- Submit troubleshooting requests.
- Complete pre-assessment questionnaires.
- Upload supporting images.
- Select preferred appointment dates.
- View appointment status.
- Receive diagnostic results.
- Approve or reject repair quotations.
- Track service progress.
- View previous service records.

**Pre-assessment workflow:**

1. **Device Information** — Device type, brand, model, and specifications.
2. **Problem Identification** — Hardware, software, performance, display, network, or maintenance.
3. **Problem Description** — Symptoms, frequency, and troubleshooting attempts.
4. **Supporting Evidence** — Optional images, videos, or screenshots.
5. **Appointment Request** — Preferred date, time, and service location.
6. **Submission** — Request enters the service queue.

**Administrative functionality:**
- Manage service categories.
- Review service requests.
- Approve or reject appointments.
- Assign technicians.
- Manage appointment availability.
- Configure preliminary service fees.
- Review service history.

**Suggested database entities:**

`service_categories`, `service_requests`, `service_request_attachments`, `appointments`, `service_locations`, `service_quotations`.

**Deliverable:** A functioning service booking and customer pre-assessment system.

### MVP 7 — Technician Workspace & Repair Management

<sub>TECHNICAL OPERATIONS</sub>

Provides technicians with a dedicated workspace for managing assigned service requests and documenting repair activities.

**Core functionality:**
- View assigned service requests.
- Access customer and device information.
- Review pre-assessment submissions.
- Record diagnostic findings.
- Generate diagnostic reports.
- Recommend replacement components.
- Prepare repair quotations.
- Record customer approvals.
- Track repair progress.
- Record replaced components.
- Generate service reports.
- Complete repair jobs.

**Proposed repair lifecycle:**

| Status | Description |
|---|---|
| Awaiting Assignment | Request has not been assigned |
| Assigned | Technician has been assigned |
| Under Diagnosis | Physical inspection is underway |
| Awaiting Approval | Quotation requires customer approval |
| Awaiting Parts | Required components are unavailable |
| Under Repair | Repair work is underway |
| Quality Testing | Device is undergoing testing |
| Ready for Release | Repair has been completed |
| Completed | Customer has received the device |
| Cancelled | Service has been cancelled |

**Suggested database entities:**

`technician_profiles`, `service_assignments`, `diagnostic_reports`, `repair_jobs`, `repair_job_items`, `repair_status_history`, `customer_approvals`.

**Important integration:**

When a technician replaces a defective component using store inventory, the replacement must be recorded through the inventory module. The system must also retain the associated customer approval and actual parts used.

**Deliverable:** An operational repair management system with technician assignments, diagnostics, repair tracking, and service history.

### MVP 8 — Business Intelligence & Analytics

<sub>BUSINESS INTELLIGENCE</sub>

Provides business owners and authorized personnel with meaningful insights into overall store performance.

**Core analytics:**
- Total revenue.
- Total orders.
- Best-selling components.
- Low-stock products.
- Inventory valuation.
- Monthly sales trends.
- Custom PC build statistics.
- Service revenue.
- Repair completion rates.
- Customer purchasing trends.

**Potential advanced capabilities:**
- Sales forecasting.
- Hardware demand prediction.
- Inventory replenishment recommendations.
- Seasonal demand analysis.
- Repair service demand analysis.
- Product profitability analysis.
- Customer retention analysis.

**Suggested database entities:**

`analytics_snapshots`, `sales_daily_summaries`, `inventory_daily_summaries`, `service_daily_summaries`.

These reporting tables are optional. Initial analytics can be generated directly from transactional records before introducing precomputed summaries.

**Deliverable:** A business intelligence dashboard connected to commerce, inventory, and technical service operations.

---

## 05. Development Dependencies

The modules have different dependencies. Establishing these relationships early allows teams to work simultaneously without waiting for every preceding system to be completely finished.

| MVP | Module | Dependencies |
|---|---|---|
| 0 | Core Foundation | None |
| 1 | Product Catalog | MVP 0 |
| 2 | Inventory | MVP 0, MVP 1 |
| 3 | PC Builder | MVP 0, MVP 1, MVP 2 |
| 4 | Recommendations | MVP 0, MVP 1, MVP 2, MVP 3 |
| 5 | E-commerce | MVP 0, MVP 1, MVP 2, MVP 3 |
| 6 | Repair & Services | MVP 0, MVP 1 |
| 7 | Technician Workspace | MVP 0, MVP 1, MVP 2, MVP 6 |
| 8 | Business Intelligence | MVP 1, MVP 2, MVP 5, MVP 6, MVP 7 |

### Recommended Development Flow

```text
                    MVP 0
               Core Foundation
                     |
          +----------+----------+
          |          |          |
        MVP 1      MVP 6      Shared UI
       Catalog    Services
          |          |
        MVP 2      MVP 7
      Inventory  Technician
          |
      +---+----------------+
      |                    |
    MVP 3                 MVP 5
  PC Builder            Commerce
      |                    |
    MVP 4                  |
 Recommendations           |
      |                    |
      +----------+---------+
                 |
               MVP 8
          Business Intelligence
```

This represents the general dependency direction, not a strict sequential development schedule. Teams may work in parallel using agreed API contracts, mock responses, and test data.

---

## 06. Team Organization

Development responsibilities should be organized around business domains rather than assigning developers to unrelated pages.

| Workstream | Assigned MVPs | Primary Responsibility |
|---|---|---|
| Core Team | MVP 0 | Architecture, authentication, and infrastructure |
| Commerce Team | MVP 1, MVP 2 | Catalog and inventory |
| Configuration Team | MVP 3, MVP 4 | Compatibility and recommendations |
| Transactions Team | MVP 5 | Checkout, payments, and orders |
| Technical Services Team | MVP 6, MVP 7 | Booking, diagnostics, and repairs |
| Analytics Team | MVP 8 | Reporting and business intelligence |

These workstreams do not require six separate teams. In smaller development groups, developers can own multiple related modules.

Each MVP should have a designated owner responsible for:
- Module architecture and database ownership.
- API contracts and documentation.
- Business logic and validation.
- Testing and acceptance criteria.
- Integration with dependent modules.
- Technical handover.

---

## 07. Database & Integration Standards

To maintain consistency across independently developed modules, FORGE PC will follow several shared architectural rules.

**1. Centralized Product Identity**

Every hardware component must have one unique product identifier. Catalog, inventory, PC Builder, and order records must reference the same product identity.

**2. Centralized Inventory Ownership**

Only the inventory module owns stock movements and inventory adjustments. Other modules request reservations, releases, or stock movements through its defined interfaces.

**3. Centralized Authentication**

All modules use the same user identity, authentication infrastructure, and authorization policies.

**4. Explicit API Contracts**

Modules communicate through documented interfaces.

| API Endpoint | Owner | Consumer |
|---|---|---|
| `GET /api/products` | Catalog | Storefront, Builder |
| `GET /api/products/{id}/specifications` | Catalog | Builder |
| `POST /api/builds/validate` | PC Builder | Storefront |
| `POST /api/recommendations` | Recommendations | Storefront |
| `POST /api/orders` | Commerce | Storefront |
| `POST /api/inventory/reservations` | Inventory | Commerce |
| `POST /api/service-requests` | Services | Storefront |
| `POST /api/diagnostics` | Technician | Services |
| `GET /api/analytics/overview` | Analytics | Admin |

These are proposed endpoints. Detailed request schemas, response formats, authentication requirements, and error handling must be documented before integration.

**5. Auditable Business Transactions**

Important operations must be traceable, including:
- Payments and refunds.
- Inventory adjustments.
- Stock reservations.
- Customer approvals.
- Order cancellations.
- Repair assignments.
- Component replacements.
- Repair completion.

**6. Backend-Enforced Business Rules**

Frontend validation improves usability, but critical business rules must always be verified on the backend.

This includes product pricing, stock availability, compatibility, payment confirmation, and user permissions.

---

## 08. Recommended Architecture

FORGE PC will initially follow a **Modular Monolith Architecture**.

This approach provides independent module organization and clear business boundaries without introducing the operational complexity of microservices.

### Proposed Project Structure

```text
forge-pc/
│
├── frontend/
│   └── src/
│       ├── modules/
│       │   ├── catalog/
│       │   ├── inventory/
│       │   ├── pc-builder/
│       │   ├── recommendations/
│       │   ├── commerce/
│       │   ├── services/
│       │   ├── technician/
│       │   └── analytics/
│       │
│       ├── components/
│       ├── layouts/
│       └── shared/
│
├── backend/
│   ├── app/
│   │   ├── Modules/
│   │   │   ├── Catalog/
│   │   │   ├── Inventory/
│   │   │   ├── PCBuilder/
│   │   │   ├── Recommendations/
│   │   │   ├── Commerce/
│   │   │   ├── Services/
│   │   │   ├── Technician/
│   │   │   └── Analytics/
│   │   │
│   │   ├── Models/
│   │   ├── Http/
│   │   └── Shared/
│   │
│   └── database/
│       ├── migrations/
│       └── seeders/
│
└── documentation/
    ├── architecture/
    ├── api-contracts/
    ├── database/
    └── mvp-specifications/
```

*This is a proposed organizational structure, not a representation of an already implemented repository.*

Each module should expose defined interfaces rather than directly manipulating another module's internal implementation.

This makes it easier to test individual business domains and provides a potential path toward service extraction if the platform eventually requires it.

---

## 09. Development Milestones

Development will be organized around working deliverables rather than arbitrary completion percentages.

| Milestone | Expected Outcome |
|---|---|
| M1 — Foundation | Authentication and role-based workspaces |
| M2 — Product Operations | Functional catalog and inventory |
| M3 — PC Configuration | Custom builds and compatibility validation |
| M4 — Intelligent Assistance | Usage-based PC recommendations |
| M5 — Online Transactions | Purchasing, payments, and order fulfillment |
| M6 — Service Requests | Repair submissions and appointment booking |
| M7 — Technical Operations | Technician diagnostics and repair tracking |
| M8 — Business Analytics | Integrated business performance dashboard |

### Definition of Done

An MVP is not considered complete simply because its interface has been developed.

Every module must satisfy the following conditions:

- [ ] Database migrations and relationships are complete.
- [ ] Backend endpoints and validation are implemented.
- [ ] Frontend functionality is connected to actual backend data.
- [ ] Authentication and authorization are enforced.
- [ ] Loading, empty, error, and success states are implemented.
- [ ] Business rules are tested.
- [ ] Integration with dependent modules is verified.
- [ ] Documentation and handover instructions are available.

---

## 10. FORGE PC 1.0 — Initial Release Scope

Although the complete platform contains eight MVPs, the initial release should prioritize delivering an integrated business experience.

### Customer Experience

Customers should be able to:

- Browse PC components.
- Explore prebuilt computers.
- Configure custom PC builds.
- Receive basic compatibility feedback.
- Purchase individual components.
- Submit repair requests.
- Book service appointments.

### Business Operations

Authorized personnel should be able to:

- Manage products and inventory.
- Process customer orders.
- Manage customer accounts.
- Review repair requests.
- Assign technicians.
- Track repair progress.
- Monitor basic sales and service activity.

Advanced AI recommendations, predictive analytics, and repair automation can be introduced in subsequent releases.

The primary objective of FORGE PC 1.0 is to establish a complete operational workflow rather than deliver eight disconnected prototypes.

---

## 11. Project Principles

The following principles will guide the development and integration of FORGE PC.

| Principle | Direction |
|---|---|
| Modularity | Every business domain has defined responsibilities |
| Maintainability | Avoid unnecessary coupling between modules |
| Data Integrity | Preserve consistency across business transactions |
| Security | Enforce backend authentication and authorization |
| Scalability | Build a foundation that supports future expansion |
| Traceability | Record important business operations |
| Integration | Connect modules through documented contracts |
| Reliability | Test functionality beyond the user interface |

---

## 12. Project Status

FORGE PC is currently in its planning and system decomposition phase.

The functional scope, proposed architecture, module dependencies, and development responsibilities have been established as the foundation for implementation.

| Development Area | Current Status |
|---|---|
| Project Concept & Scope | Defined |
| System Decomposition | Defined |
| MVP Specifications | Drafted |
| User Roles | Proposed |
| Database Architecture | Under Design |
| API Contracts | Proposed |
| Frontend Architecture | Proposed |
| Backend Architecture | Proposed |
| Module Implementation | Pending |
| System Integration | Pending |
| Testing & Deployment | Pending |

*Statuses describe the current project planning documentation and should not be interpreted as confirmation of implemented functionality.*

---

## 13. Documentation & Development Guidelines

Technical documentation will be maintained alongside implementation to ensure consistency across development teams.

Recommended documentation:

```text
documentation/
├── architecture/
│   ├── system-overview.md
│   └── module-boundaries.md
│
├── api-contracts/
│   ├── catalog-api.md
│   ├── inventory-api.md
│   ├── builder-api.md
│   ├── commerce-api.md
│   └── services-api.md
│
├── database/
│   ├── erd.md
│   └── database-conventions.md
│
└── mvp-specifications/
    ├── mvp-0-foundation.md
    ├── mvp-1-catalog.md
    ├── mvp-2-inventory.md
    ├── mvp-3-pc-builder.md
    ├── mvp-4-recommendations.md
    ├── mvp-5-commerce.md
    ├── mvp-6-services.md
    ├── mvp-7-technician.md
    └── mvp-8-analytics.md
```

---

## 14. License

Licensing and distribution terms have not yet been finalized.

---

**FORGE PC**

*Build smarter. Choose better. Power forward.*
