USE [mubusassessment]
GO

/****** Object:  Table [dbo].[dashboard_groups]    Script Date: 10/20/2015 12:36:16 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[dashboard_groups](
	[group_id] [varchar](150) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[group_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/******************************************************/

USE [mubusassessment]
GO

/****** Object:  Table [dbo].[dashboard_sections]    Script Date: 10/20/2015 12:37:02 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[dashboard_sections](
	[section_id] [varchar](50) NOT NULL,
	[section_name] [varchar](max) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[section_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/**************************************************/
USE [mubusassessment]
GO

/****** Object:  Table [dbo].[dashboard_topics]    Script Date: 10/20/2015 12:38:25 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[dashboard_topics](
	[topic_id] [varchar](50) NOT NULL,
	[topic_name] [varchar](max) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[topic_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/******************************************************/

USE [mubusassessment]
GO

/****** Object:  Table [dbo].[dashboard_urls]    Script Date: 10/20/2015 12:37:55 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[dashboard_urls](
	[url_id] [varchar](50) NOT NULL,
	[url_name] [varchar](max) NOT NULL,
	[topic_id] [varchar](50) NULL,
	[section_id] [varchar](50) NULL,
	[url_address] [varchar](max) NULL,
PRIMARY KEY CLUSTERED 
(
	[url_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[dashboard_urls]  WITH CHECK ADD FOREIGN KEY([section_id])
REFERENCES [dbo].[dashboard_sections] ([section_id])
GO

ALTER TABLE [dbo].[dashboard_urls]  WITH CHECK ADD FOREIGN KEY([topic_id])
REFERENCES [dbo].[dashboard_topics] ([topic_id])
GO

/**************************************************/

USE [mubusassessment]
GO

/****** Object:  Table [dbo].[dashboard_linkURLtoGroup]    Script Date: 10/20/2015 12:38:52 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[dashboard_linkURLtoGroup](
	[url_id] [varchar](50) NULL,
	[group_id] [varchar](150) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[dashboard_linkURLtoGroup]  WITH CHECK ADD FOREIGN KEY([group_id])
REFERENCES [dbo].[dashboard_groups] ([group_id])
GO

ALTER TABLE [dbo].[dashboard_linkURLtoGroup]  WITH CHECK ADD FOREIGN KEY([url_id])
REFERENCES [dbo].[dashboard_urls] ([url_id])
GO

